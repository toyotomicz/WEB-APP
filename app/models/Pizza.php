<?php
namespace App\Models;

use App\Models\MyDatabase;

class Pizza {
    private MyDatabase $db;

    public function __construct(MyDatabase $db) {
        $this->db = $db;
    }

    /**
     * Získá všechny typy pizzy z databáze.
     *
     * @return array Pole všech typů pizzy.
     */
    public function getAllPizzaTypes(): array {
        return $this->db->getAllPizzaTypes();
    }

    /**
     * Přidá nový typ pizzy do databáze.
     *
     * @param string $name Název pizzy.
     * @param float $price Cena pizzy.
     * @param string $imagePath Cesta k obrázku pizzy.
     * @return bool Vrací true při úspěchu, jinak false.
     */
    public function addPizzaType(string $name, float $price, string $imagePath): bool {
        $pizzaData = [
            'name' => $name,
            'price' => $price,
            'image_path' => $imagePath
        ];

        return $this->db->addPizzaType($pizzaData);
    }
    
}
?>
