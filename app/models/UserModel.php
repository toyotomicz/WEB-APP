<?php
namespace App\Models;

class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registerUser($username, $email, $password) {
        // Check if username or email already exists
        if ($this->getUserByUsername($username) || $this->getUserByEmail($email)) {
            return false; // User already exists
        }

        // Insert new user into the database
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, role_id) VALUES (?, ?, ?, 2)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    public function loginUser($identifier, $password) {
        // Check if the identifier is an email or username
        $user = $this->getUserByUsername($identifier) ?: $this->getUserByEmail($identifier);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Successful login
        }
        return false; // Failed login
    }

    public function getUserByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateUser($id, $username, $email, $password) {
        // Hash the new password if provided
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Update user details in the database
        $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        return $stmt->execute([$username, $email, $hashedPassword, $id]);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
