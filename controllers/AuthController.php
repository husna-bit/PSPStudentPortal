<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function login() {
    global $pdo;
    if (session_status() === PHP_SESSION_NONE) session_start();

    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nric = trim($_POST['nric'] ?? '');
        $password = $_POST['password'] ?? '';

        // ✅ SERVER-SIDE VALIDATION
        if (empty($nric) || empty($password)) {
            $error = "Please fill in all fields.";
        } else {
            $userModel = new User($pdo);
            $user = $userModel->findByNric($nric);
            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                header("Location: index.php?page=profile");
                exit;
            } else {
                $error = "Invalid NRIC or password.";
            }
        }
    }
    require __DIR__ . '/../views/auth/login.php';
}

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    }
}
?>