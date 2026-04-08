<?php
if (session_status() === PHP_SESSION_NONE) session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


if ($_SESSION['role'] === 'admin') {
    require_once 'app/controllers/UserController.php';
    $controller = new UserController();
    $controller->dashboard();


} else {
    require_once 'app/controllers/RecipeController.php';
    $controller = new RecipeController();
    $controller->dashboard();
}
?>
