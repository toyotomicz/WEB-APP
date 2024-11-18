<?php
namespace App\Models;

use PDO;
use PDOException;
use App\Config\Settings;

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
            die("Error executing query: " . $e->getMessage());
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

    public function prepare($sql) {
        return $this->pdo->prepare($sql);
    }

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    public function commit() {
        return $this->pdo->commit();
    }

    public function rollBack() {
        return $this->pdo->rollBack();
    }
    // Example method demonstrating transaction usage
    public function addMultipleUsers(array $users) {
        try {
            $this->beginTransaction();
            foreach ($users as $userdata) {
                $this->addUser($userdata);
            }
            $this->commit();
            return true;
        } catch (PDOException $e) {
            $this->rollBack();
            die("Transaction failed: " . $e->getMessage());
        }
    }
}
?>
