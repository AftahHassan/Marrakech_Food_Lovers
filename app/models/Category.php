<?php

require_once __DIR__ . '/../models/Database.php';

class category {
    private $id;
    private $name;

    public function getId(){
        return $this -> id;
    }

    public function getName(){
        return $this -> name;
    }


    public function getAll() {
        $db =Database :: getInstance();

        $stmt = $db ->query('SELECT * FROM categories ORDER BY name ASC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getById($id) {
        $db =Database :: getInstance();
        $stmt = $db ->query('SELECT * FROM categories WHERE id = ?', [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function create($name) {
        $db =Database :: getInstance();

        return $db->query(
            'INSERT INTO categories(name) VALUES(?)',
            [$name]
        );
    }

     public function update($id, $name) {
        $db = Database::getInstance();
        return $db->query(
            'UPDATE categories SET name = ? WHERE id = ?',
            [$name, $id]
        );
    }


    public function delete($id) {
        $db = Database::getInstance();
        return $db->query(
            'DELETE FROM categories WHERE id = ?',
            [$id]
        );
    }


    // Compter toutes les catégories (admin dashboard)
    public function countAll() {
        $db   = Database::getInstance();
        $stmt = $db->query('SELECT COUNT(*) AS total FROM categories');
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }




}








?>