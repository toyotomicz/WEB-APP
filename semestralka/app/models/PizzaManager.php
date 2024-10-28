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
}
?>
