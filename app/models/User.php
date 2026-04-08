<?php
require_once __DIR__ . '/../models/Database.php';

class User {

    // ---- ATTRIBUTS ----
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;

    // ---- GETTERS ----
    public function getId()       { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getEmail()    { return $this->email; }
    public function getRole()     { return $this->role; }

    // ---- REGISTER ----
    public function register($username, $email, $password) {
        $db   = Database::getInstance();
        $hash = password_hash($password, PASSWORD_BCRYPT);
        return $db->query(
            'INSERT INTO users(username, email, password, role) VALUES(?, ?, ?, ?)',
            [$username, $email, $hash, 'cuisinier']
        );
    }

    // ---- LOGIN ----
    public function login($email, $password) {
        $db   = Database::getInstance();
        $stmt = $db->query('SELECT * FROM users WHERE email = ?', [$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

           if($user && password_verify($password, $user['password'])){
              return $user;
           }
             return null;

    }

    // ---- FIND BY ID ----
    public function findById($id) {
        $db   = Database::getInstance();
        $stmt = $db->query('SELECT * FROM users WHERE id = ?', [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ---- FIND BY EMAIL ----
    public function findByEmail($email) {
        $db   = Database::getInstance();
        $stmt = $db->query('SELECT * FROM users WHERE email = ?', [$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ---- ADMIN : tous les users ----
    public function getAllUsers() {
        $db   = Database::getInstance();
        $stmt = $db->query(
            'SELECT id, username, email, role, created_at FROM users'
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ---- ADMIN : -supprimer un user ----
    public function deleteUser($id) {
        $db = Database::getInstance();
        return $db->query('DELETE FROM users WHERE id = ?', [$id]);
    }

    // ---- ADMIN : compter tous les users ----
    public function countAll() {
        $db   = Database::getInstance();
        $stmt = $db->query('SELECT COUNT(*) AS total FROM users');
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
?>