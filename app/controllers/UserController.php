<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../models/Category.php';

class UserController {

    private $userModel;
    private $recipeModel;
    private $categoryModel;

    public function __construct() {
        $this->userModel     = new User();
        $this->recipeModel   = new Recipe();
        $this->categoryModel = new Category();
    }

    // ---- ADMIN : dashboard stats ----
    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $totalUsers      = $this->userModel->countAll();
        $totalRecipes    = $this->recipeModel->countAll();
        $totalCategories = $this->categoryModel->countAll();

        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    // ---- ADMIN : liste users ----
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $users = $this->userModel->getAllUsers();
        require_once __DIR__ . '/../views/admin/users.php';
    }

    // ---- ADMIN : supprimer user ----
    public function delete() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $id = $_GET['id'] ?? null;
        $this->userModel->deleteUser($id);

        header('Location: /Marrakech_Food_Lovers/index.php?action=users');
        exit();
    }
}

?>