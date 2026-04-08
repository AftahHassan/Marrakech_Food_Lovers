<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marrakech Food Lovers</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Marrakech_Food_Lovers/public/css/style.css">
</head>
<body>

<header>
    <nav>

        <!-- LOGO -->
        <a href="/Marrakech_Food_Lovers/index.php" class="logo">
            🍽️ Marrakech Food Lovers
        </a>

        <!-- LIENS -->
        <ul>
            <?php if (isset($_SESSION['user_id'])) : ?>

                <!-- ✅ ADMIN connecté -->
                <?php if ($_SESSION['role'] === 'admin') : ?>
                    <li><a href="/Marrakech_Food_Lovers/dashboard.php">📊 Dashboard</a></li>
                    <li><a href="/Marrakech_Food_Lovers/admin/users.php">👥 Cuisiniers</a></li>
                    <li><a href="/Marrakech_Food_Lovers/admin/recipes.php">🍽️ Recettes</a></li>
                    <li><a href="/Marrakech_Food_Lovers/admin/categories.php">🗂️ Catégories</a></li>

                <!-- ✅ CUISINIER connecté -->
                <?php else : ?>
                    <li><a href="/Marrakech_Food_Lovers/dashboard.php">🏠 Dashboard</a></li>
                    <li><a href="/Marrakech_Food_Lovers/create_recipe.php">➕ Nouvelle recette</a></li>
                    <li><a href="/Marrakech_Food_Lovers/category.php">🗂️ Catégories</a></li>

                <?php endif; ?>

                <!-- DÉCONNEXION -->
                <li>
                    <a href="/Marrakech_Food_Lovers/logout.php">
                        🔓 Déconnexion (<?= htmlspecialchars($_SESSION['username']) ?>)
                    </a>
                </li>

            <?php else : ?>

                <!-- ❌ NON CONNECTÉ -->
                <li><a href="/Marrakech_Food_Lovers/login.php">🔐 Connexion</a></li>
                <li><a href="/Marrakech_Food_Lovers/register.php">📝 Inscription</a></li>

            <?php endif; ?>
        </ul>

    </nav>
</header>

<main>