<?php
require_once 'app/models/Database.php';

// Config admin
$username = 'admin';
$email = 'admin@foodlovers.com';
$password = 'admin123';

// Hash password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Recuperer instance DB
$db = Database::getInstance();

try {
    // verifier si existe
    $check = $db->query("SELECT id FROM users WHERE email = ?", [$email]);

    if ($check->fetch()) {
        echo "<div style='color: orange;'>Admin existe deja</div>";
        exit();
    }

    // insertion
    $db->query(
        "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')",
        [$username, $email, $hashed_password]
    );

    echo "<div style='color: green;'>";
    echo "<h2>Succes</h2>";
    echo "Admin cree<br>";
    echo "Email : $email<br>";
    echo "Password : $password<br>";
    echo "</div>";

} catch (Exception $e) {
    echo "<div style='color:red;'>Erreur : " . $e->getMessage() . "</div>";
}
?>