<?php
namespace App\Models;

class PizzaManager {
    private $db;

    // Změňte typ parametru na plně kvalifikovaný s namespacem
    public function __construct(MyDatabase $db) {
        $this->db = $db;
    }

    public function getPizzas() {
        return $this->db->getAllPizzaTypes();
    }

    public function showAddPizzaForm() {
        require_once __DIR__ . '/../views/addPizzaForm.php';
    }

    public function addPizza($name, $price, $imagePath) {
        $query = "INSERT INTO pizza_types (name, price, image_path) VALUES (:name, :price, :image)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $imagePath);
        return $stmt->execute();
    }
}
?>
