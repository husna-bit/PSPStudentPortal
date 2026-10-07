<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

class PasswordController {
    public function change() {
        global $pdo;
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $message = '';
        $messageType = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = $_POST['old_password'] ?? '';
            $new = $_POST['new_password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';

            if (empty($old) || empty($new) || empty($confirm)) {
                $message = "All fields are required.";
                $messageType = "danger";
            } elseif ($new !== $confirm) {
                $message = "New password and confirm password do not match.";
                $messageType = "danger";
            } elseif (strlen($new) < 6) {
                $message = "New password must be at least 6 characters.";
                $messageType = "danger";
            } else {
                $userModel = new User($pdo);
                $user = $userModel->findById($_SESSION['user_id']);

                if (!password_verify($old, $user['password'])) {
                    $message = "Invalid old password.";
                    $messageType = "danger";
                } else {
                    $newHash = password_hash($new, PASSWORD_DEFAULT);
                    $userModel->updatePassword($_SESSION['user_id'], $newHash);
                    $message = "Password updated successfully!";
                    $messageType = "success";
                }
            }
        }
        require __DIR__ . '/../views/password/change.php';
    }
}
?>