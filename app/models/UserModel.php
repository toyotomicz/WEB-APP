<?php
namespace App\Models;

use PDO;
use Exception;

class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registerUser($username, $email, $password) {
        // Validace e-mailu
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false; // Neplatný e-mail
        }

        // Kontrola, zda uživatel již existuje
        if ($this->getUserByUsername($username) || $this->getUserByEmail($email)) {
            return false; // Uživatel již existuje
        }

        // Vložení nového uživatele do databáze
        try {
            $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, role_id) VALUES (?, ?, ?, 2)");
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            return $stmt->execute([$username, $email, $hashedPassword]);
        } catch (Exception $e) {
            // Zpracování výjimky
            return false; // Můžete logovat chybu pro další analýzu
        }
    }

    public function loginUser($identifier, $password) {
        // Zkontrolujeme, zda je identifier email nebo uživatelské jméno
        $user = $this->getUserByUsername($identifier) ?: $this->getUserByEmail($identifier);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Úspěšné přihlášení
        }
        return false; // Neúspěšné přihlášení
    }

    public function getUserByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        return $user ?: null; // Pokud uživatel neexistuje, vrátí null
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return $user ?: null; // Pokud uživatel neexistuje, vrátí null
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        return $user ?: null; // Pokud uživatel neexistuje, vrátí null
    }

    public function updateUser($id, $username, $email, $password) {
        // Hashování nového hesla, pokud je poskytnuto
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Aktualizace údajů uživatele v databázi
        try {
            $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
            return $stmt->execute([$username, $email, $hashedPassword, $id]);
        } catch (Exception $e) {
            // Zpracování výjimky
            return false;
        }
    }

    public function deleteUser($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (Exception $e) {
            // Zpracování výjimky
            return false;
        }
    }

    // Nová metoda pro získání role uživatele na základě role_id
    public function getUserRole($userId) {
        try {
            $stmt = $this->pdo->prepare("SELECT role_id FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            // Zpracování výjimky
            return false;
        }
    }
}
?>
