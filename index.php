<?php
session_start();

require_once __DIR__ . '/app/controllers/AuthController.php';
require_once __DIR__ . '/app/controllers/RecipeController.php';
require_once __DIR__ . '/app/controllers/CategoryController.php';
require_once __DIR__ . '/app/controllers/UserController.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {

    // --- AUTH ---
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    // --- ADMIN ---
    case 'dashboard':
        $controller = new UserController();
        $controller->dashboard();
        break;

    case 'users':
        $controller = new UserController();
        $controller->index();          // ← injecte $users dans la vue
        break;

    case 'delete_user':
        $controller = new UserController();
        $controller->delete();
        break;

    case 'recipes':
        $controller = new RecipeController();
        $controller->adminIndex();
        break;

    case 'categories':
        $controller = new CategoryController();
        $controller->index();
        break;

    case 'add_category':
        $controller = new CategoryController();
        $controller->add();
        break;

    case 'edit_category':
        $controller = new CategoryController();
        $controller->edit();
        break;

    case 'delete_category':
        $controller = new CategoryController();
        $controller->delete();
        break;

    // --- CUISINIER ---
    case 'my_recipes':
        $controller = new RecipeController();
        $controller->index();
        break;

    case 'create_recipe':
        $controller = new RecipeController();
        $controller->create();
        break;

    case 'edit_recipe':
        $controller = new RecipeController();
        $controller->edit();
        break;

    case 'delete_recipe':
        $controller = new RecipeController();
        $controller->delete();
        break;

    default:
        require_once __DIR__ . '/app/views/auth/splash.php';
        break;
}
?>