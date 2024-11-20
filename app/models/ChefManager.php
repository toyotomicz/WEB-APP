<?php
namespace App\Models;

use PDO;

class ChefManager {
    private $db;

    public function __construct(MyDatabase $db) {
        $this->db = $db;
    }

    /**
     * Vytvoří nového kuchaře.
     *
     * @param string $username Uživatelské jméno
     * @param string $email Emailová adresa
     * @param string $password Heslo (plain-text)
     * @return bool True při úspěchu, jinak false
     * @throws \InvalidArgumentException Pokud jsou vstupy neplatné
     */
    public function createChef(string $username, string $email, string $password): bool {
        // Validace vstupů
        if (empty($username) || empty($email) || empty($password)) {
            throw new \InvalidArgumentException('Všechna pole jsou povinná.');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Neplatná emailová adresa.');
        }

        // Hashování hesla
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Připravení a vykonání dotazu
        $query = "INSERT INTO users (username, email, password, role) 
                    VALUES (:username, :email, :password, :role)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':role', 'chef', PDO::PARAM_STR);

        return $stmt->execute();
    }
}
