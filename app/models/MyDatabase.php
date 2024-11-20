<?php
namespace App\Models;

use PDO;
use PDOException;
use PDOStatement;
use App\Config\Settings;

class MyDatabase {
    private $pdo;

    public function __construct(string $host, string $dbname, string $user, string $password) {
        try {
            $this->pdo = new PDO(
                "mysql:host={$host};dbname={$dbname}",
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
            $this->pdo->exec("SET NAMES utf8mb4");
        } catch (PDOException $e) {
            throw new PDOException("Connection failed: " . $e->getMessage());
        }
    }

    public function query(string $sql, array $params = []): ?PDOStatement {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            // Log the error and rethrow the exception
            error_log("Query error: " . $e->getMessage());
            throw $e;
        }
    }

    public function fetchAll(string $sql, array $params = []): array {
        return $this->query($sql, $params)->fetchAll();
    }

    public function getAllUsers(): array {
        return $this->fetchAll("SELECT * FROM " . $this->validateTable(Settings::TABLE_USERS));
    }

    public function addUser(array $userdata): bool {
        if (empty($userdata["name"]) || !is_numeric($userdata['role_id'])) {
            throw new \InvalidArgumentException("Invalid user data.");
        }

        $sql = "INSERT INTO " . $this->validateTable(Settings::TABLE_USERS) . " (name, role_id) 
                VALUES (:name, :role_id)";
        $params = [
            ':name' => $userdata['name'],
            ':role_id' => $userdata['role_id']
        ];
        return $this->query($sql, $params)->rowCount() > 0;
    }

    public function getAllPizzaTypes(): array {
        return $this->fetchAll("SELECT * FROM " . $this->validateTable(Settings::TABLE_PIZZA_TYPES));
    }

    public function lastInsertId(): string {
        return $this->pdo->lastInsertId();
    }

    public function beginTransaction(): void {
        $this->pdo->beginTransaction();
    }

    public function commit(): void {
        $this->pdo->commit();
    }

    public function rollBack(): void {
        $this->pdo->rollBack();
    }

    /**
     * Přidá více uživatelů v jedné transakci.
     *
     * @param array $users Pole uživatelských dat
     * @return bool True při úspěchu
     * @throws PDOException Pokud transakce selže
     */
    public function addMultipleUsers(array $users): bool {
        try {
            $this->beginTransaction();
            foreach ($users as $userdata) {
                $this->addUser($userdata);
            }
            $this->commit();
            return true;
        } catch (PDOException $e) {
            $this->rollBack();
            error_log("Transaction failed: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Validuje název tabulky, aby nedošlo k SQL Injection.
     *
     * @param string $tableName Název tabulky
     * @return string Validovaný název tabulky
     * @throws \InvalidArgumentException Pokud je název tabulky neplatný
     */
    private function validateTable(string $tableName): string {
        $validTables = [Settings::TABLE_USERS, Settings::TABLE_PIZZA_TYPES];
        if (!in_array($tableName, $validTables, true)) {
            throw new \InvalidArgumentException("Invalid table name.");
        }
        return $tableName;
    }

    public function addPizzaType(array $pizzaData): bool {
        $sql = "INSERT INTO pizza_types (name, price, image_path) VALUES (:name, :price, :image_path)";
        $stmt = $this->prepare($sql);
    
        return $stmt->execute([
            ':name' => $pizzaData['name'],
            ':price' => $pizzaData['price'],
            ':image_path' => $pizzaData['image_path']
        ]);
    }
    
    public function prepare($sql) {
        return $this->pdo->prepare($sql);
    }
    public function getPdo(): PDO {
        return $this->pdo;
    }
}
?>
