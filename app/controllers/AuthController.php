<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {

    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // ---- SPLASH ---
    public function splash() {
        require_once __DIR__ . '/../views/auth/splash.php';
    }

    // ---- LOGIN ----
    public function login() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email    = trim($_POST['email']);
            $password = trim($_POST['password']);

            $user = $this->userModel->login($email, $password);

            if ($user) {
                $_SESSION['user_id']  = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role']     = $user['role'];

                header('Location: dashboard.php');
                exit();

            } else {
                $error = 'Email ou mot de passe incorrect';
                require_once __DIR__ . '/../views/auth/login.php';
            }

        } else {
            require_once __DIR__ . '/../views/auth/login.php';
        }
    }

    // ---- REGISTER ----
    public function register() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username']);
            $email    = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Validation
            if (empty($username) || empty($email) || empty($password)) {
                $error = 'Tous les champs sont obligatoires';
                require_once __DIR__ . '/../views/auth/register.php';
                return;
            }

            // Vérifier si email existe déjà
            $existingUser = $this->userModel->findByEmail($email);
            if ($existingUser) {
                $error = 'Cet email est déjà utilisé';
                require_once __DIR__ . '/../views/auth/register.php';
                return;
            }

            // ✅ Insert dans users
            $this->userModel->register($username, $email, $password);

            // ✅ Redirection vers login
            header('Location: login.php');
            exit();

        } else {
            require_once __DIR__ . '/../views/auth/register.php';
        }
    }

    // ---- LOGOUT ----
    public function logout() {
        session_start();
        session_destroy();
        header('Location: login.php');
        exit();
    }
}
?>