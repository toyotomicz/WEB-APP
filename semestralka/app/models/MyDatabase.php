<?php
namespace App\Models;

use PDO;  // Přidejte tento řádek na začátek!
use PDOException;  // Pokud používáte i PDOException, přidejte i tento
use App\Config\Settings;  // Přidáno pro použití konstant z třídy Settings

class MyDatabase {
    private $pdo;

    public function __construct($host, $dbname, $user, $password) {
        try {
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$dbname",
                $user,
                $password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET NAMES utf8");
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Chyba při provádění dotazu: " . $e->getMessage());
        }
    }

    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        return $this->fetchAll("SELECT * FROM " . Settings::TABLE_USERS);
    }

    public function addUser(array $userdata) {
        if (empty($userdata["name"])) {
            return false;
        }

        $sql = "INSERT INTO " . Settings::TABLE_USERS . " (name, role_id) VALUES (:name, :role_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $userdata['name']);
        $stmt->bindParam(':role_id', $userdata['role_id']);
        return $stmt->execute();
    }

    public function getAllPizzaTypes() {
        return $this->fetchAll("SELECT * FROM " . Settings::TABLE_PIZZA_TYPES);
    }
}
?>
