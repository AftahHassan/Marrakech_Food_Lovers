<?php
require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../models/Category.php';


class RecipeController {
    private $recipeModel;
    private $categoryModel;
    public function __construct() {
        $this->recipeModel   = new Recipe();
        $this->categoryModel = new Category();
    }
    // ---- CUISINIER : mes recettes ----
    public function dashboard() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    $category_filter = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

    // Tous voient TOUTES les recettes
    if ($category_filter > 0) {
        $recipes = $this->recipeModel->getByCategory($category_filter);
    } else {
        $recipes = $this->recipeModel->getAll();
    }

    $categories = $this->categoryModel->getAll();
    require_once __DIR__ . '/../views/cuisinier/dashboard.php';
}

    // ---- CRÉER une recette ----
    public function create() {
        if (session_status() === PHP_SESSION_NONE) session_start();


        $categories = $this->categoryModel->getAll();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $title       = trim($_POST['title']);
            $ingredients = trim($_POST['ingredients']);
            $description = trim($_POST['description']);
            $category_id = $_POST['category_id'];


            if (empty($title) || empty($ingredients) || empty($description)) {
                $error = 'Tous les champs sont obligatoires';
                require_once __DIR__ . '/../views/cuisinier/create.php';
                return;
            }


            $this->recipeModel->create(
                $title,
                $ingredients,
                $description,
                $_SESSION['user_id'],
                $category_id
            );


            header('Location: /Marrakech_Food_Lovers/dashboard.php');
            exit();


        } else {
            require_once __DIR__ . '/../views/cuisinier/create.php';
        }
    }


    // ---- MODIFIER une recette ----
    public function edit() {
        if (session_status() === PHP_SESSION_NONE) session_start();


        $id = $_GET['id'] ?? null;

        // delete the condition !$this->recipeModel->isOwner($id, $_SESSION['user_id'])
        
        if (!$id) {
            header('Location: /Marrakech_Food_Lovers/dashboard.php');
            exit();
        }


        $recipe     = $this->recipeModel->getById($id);
        $categories = $this->categoryModel->getAll();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $title       = trim($_POST['title']);
            $ingredients = trim($_POST['ingredients']);
            $description = trim($_POST['description']);
            $category_id = $_POST['category_id'];


            if (empty($title) || empty($ingredients) || empty($description)) {
                $error = 'Tous les champs sont obligatoires';
                require_once __DIR__ . '/../views/cuisinier/edit.php';
                return;
            }


            $this->recipeModel->update($id, $title, $ingredients, $description, $category_id);


            header('Location: /Marrakech_Food_Lovers/admin_recipes.php');
            exit();


        } else {
            require_once __DIR__ . '/../views/cuisinier/edit.php';
        }
    }


    // ---- SUPPRIMER une recette ----
    public function delete() {
        if (session_status() === PHP_SESSION_NONE) session_start();


        $id = $_GET['id'] ?? null;


        // Vérification propriété
        if (!$id || !$this->recipeModel->isOwner($id, $_SESSION['user_id'])) {
            header('Location: /Marrakech_Food_Lovers/dashboard.php');
            exit();
        }


        $this->recipeModel->delete($id);
        header('Location: /Marrakech_Food_Lovers/dashboard.php');
        exit();
    }


    // ---- DÉTAIL une recette ----
    public function show() {
        if (session_status() === PHP_SESSION_NONE) session_start();


        $id     = $_GET['id'] ?? null;
        $recipe = $this->recipeModel->getById($id);


        require_once __DIR__ . '/../views/cuisinier/show.php';
    }


    // ---- ADMIN : toutes les recettes ----
    public function adminIndex() {
        if (session_status() === PHP_SESSION_NONE) session_start();


        $recipes = $this->recipeModel->getAll();
        require_once __DIR__ . '/../views/admin/recipes.php';
    }


    // ---- ADMIN : supprimer n'importe quelle recette ----
    public function adminDelete() {
        if (session_status() === PHP_SESSION_NONE) session_start();


        $id = $_GET['id'] ?? null;
        $this->recipeModel->delete($id);


        header('Location: /Marrakech_Food_Lovers/admin/recipes.php');
        exit();
    }


    // ---- PUBLIC : filtrer par catégorie ----
    public function filter() {
        $category_id = $_GET['category_id'] ?? null;
        $recipes     = $this->recipeModel->getByCategory($category_id);
        $categories  = $this->categoryModel->getAll();


        require_once __DIR__ . '/../views/cuisinier/dashboard.php';
    }
}
?>


