<?php
require_once __DIR__ . '/Database.php';

class Recipe {

    // ---- ATTRIBUTS ----
    private $id;
    private $title;
    private $ingredients;
    private $description;
    private $user_id;
    private $category_id;
    private $created_at;

    // ---- GETTERS ----
    public function getId()          { return $this->id; }
    public function getTitle()       { return $this->title; }
    public function getIngredients() { return $this->ingredients; }
    public function getDescription() { return $this->description; }
    public function getUserId()      { return $this->user_id; }
    public function getCategoryId()  { return $this->category_id; }
    public function getCreatedAt()   { return $this->created_at; }

    // ---- CUISINIER ----

    public function getByUser($user_id) {
        $db   = Database::getInstance();
        $stmt = $db->query(
            'SELECT r.*, c.name AS category_name 
             FROM recipes r 
             LEFT JOIN categories c ON r.category_id = c.id 
             WHERE r.user_id = ? 
             ORDER BY r.created_at DESC',
            [$user_id]
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $db   = Database::getInstance();
        $stmt = $db->query(
            'SELECT r.*, c.name AS category_name, u.username 
             FROM recipes r 
             LEFT JOIN categories c ON r.category_id = c.id
             LEFT JOIN users u ON r.user_id = u.id
             WHERE r.id = ?',
            [$id]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $ingredients, $description, $user_id, $category_id) {
        $db = Database::getInstance();
        return $db->query(
            'INSERT INTO recipes(title, ingredients, description, user_id, category_id) 
             VALUES(?, ?, ?, ?, ?)',
            [$title, $ingredients, $description, $user_id, $category_id]
        );
    }

    public function update($id, $title, $ingredients, $description, $category_id) {
        $db = Database::getInstance();
        return $db->query(
            'UPDATE recipes 
             SET title = ?, ingredients = ?, description = ?, category_id = ? 
             WHERE id = ?',
            [$title, $ingredients, $description, $category_id, $id]
        );
    }

    public function delete($id) {
        $db = Database::getInstance();
        return $db->query(
            'DELETE FROM recipes WHERE id = ?',
            [$id]
        );
    }

    public function isOwner($recipe_id, $user_id) {
        $db   = Database::getInstance();
        $stmt = $db->query(
            'SELECT id FROM recipes WHERE id = ? AND user_id = ?',
            [$recipe_id, $user_id]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // ---- ADMIN ----

    public function getAll() {
        $db   = Database::getInstance();
        $stmt = $db->query(
            'SELECT r.*, c.name AS category_name, u.username 
             FROM recipes r 
             LEFT JOIN categories c ON r.category_id = c.id
             LEFT JOIN users u ON r.user_id = u.id
             ORDER BY r.created_at DESC'
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ---- PUBLIC ----

    public function getByCategory($category_id) {
        $db   = Database::getInstance();
        $stmt = $db->query(
            'SELECT r.*, c.name AS category_name, u.username 
             FROM recipes r 
             LEFT JOIN categories c ON r.category_id = c.id
             LEFT JOIN users u ON r.user_id = u.id
             WHERE r.category_id = ?
             ORDER BY r.created_at DESC',
            [$category_id]
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll() {
        $db   = Database::getInstance();
        $stmt = $db->query('SELECT COUNT(*) AS total FROM recipes');
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
?>