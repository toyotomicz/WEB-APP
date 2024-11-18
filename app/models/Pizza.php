<?php
namespace App\Models;

class Pizza {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllPizzaTypes() {
        return $this->db->getAllPizzaTypes();
    }

    public function addPizzaType($name, $price, $image_path) {
        return $this->db->addPizzaType(['name' => $name, 'price' => $price, 'image_path' => $image_path]);
    }
}
?>
