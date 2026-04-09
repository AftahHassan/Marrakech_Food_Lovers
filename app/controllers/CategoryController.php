<?php
require_once __DIR__ . '/../models/Category.php';


class CategoryController {


    private $categoryModel;


    public function __construct() {
        $this->categoryModel = new Category();
    }


    // ---- ADMIN : liste catégories ----
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();


        $categories = $this->categoryModel->getAll();
        require_once __DIR__ . '/../views/admin/categories.php';
    }


    // ---- ADMIN : ajouter catégorie ----
    public function create() {
        if (session_status() === PHP_SESSION_NONE) session_start();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $name = trim($_POST['name']);


            if (empty($name)) {
                $error = 'Le nom est obligatoire';
                require_once __DIR__ . '/../views/admin/add_category.php';
                return;
            }


            $this->categoryModel->create($name);
            // Change the path of redirect
            header('Location: /Marrakech_Food_Lovers/index.php?action=categories');
            exit();


        } else {
            require_once __DIR__ . '/../views/admin/add_category.php';
        }
    }


    // ---- ADMIN : modifier catégorie ----
    public function edit() {
        if (session_status() === PHP_SESSION_NONE) session_start();


        $id       = $_GET['id'] ?? null;
        $category = $this->categoryModel->getById($id);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $name = trim($_POST['name']);


            if (empty($name)) {
                $error = 'Le nom est obligatoire';
                require_once __DIR__ . '/../views/admin/edit_category.php';
                return;
            }


            $this->categoryModel->update($id, $name);
            header('Location: /Marrakech_Food_Lovers/index.php?action=categories');
            exit();


        } else {
            require_once __DIR__ . '/../views/admin/edit_category.php';
        }
    }


    // ---- ADMIN : supprimer catégorie ----
    public function delete() {
        if (session_status() === PHP_SESSION_NONE) session_start();


        $id = $_GET['id'] ?? null;
        $this->categoryModel->delete($id);


        // header('Location: /Marrakech_Food_Lovers/admin/categories.php');
        header('Location: /Marrakech_Food_Lovers/index.php?action=categories');
        exit();
    }
}
?>
