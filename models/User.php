<?php

class User {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Find user by NRIC for login
    public function findByNric($nric) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM users WHERE nric = ?"
        );

        $stmt->execute([$nric]);

        return $stmt->fetch();
    }

    // Find user by ID
    public function findById($id) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM users WHERE id = ?"
        );

        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    // Update password
    public function updatePassword($id, $newHash) {
        $stmt = $this->pdo->prepare(
            "UPDATE users SET password = ? WHERE id = ?"
        );

        return $stmt->execute([$newHash, $id]);
    }

    // Update profile picture filename
    public function updateProfilePicture($id, $filename) {
        $stmt = $this->pdo->prepare(
            "UPDATE users 
             SET profile_picture = ? 
             WHERE id = ?"
        );

        return $stmt->execute([$filename, $id]);
    }
}
?>