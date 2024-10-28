<?php
namespace App\Controllers;

use App\Models\MyDatabase;
use App\Models\PizzaManager;
use App\Models\CartManager;
use App\Config\Settings;

class PizzaController {
    private $db;

    public function __construct() {
        $this->db = new MyDatabase(Settings::DB_SERVER, Settings::DB_NAME, Settings::DB_USER, Settings::DB_PASS);
    }

    public function index() {
        $pizzaManager = new PizzaManager($this->db);
        $pizzas = $pizzaManager->getPizzas();

        // Zpracování POST žádosti pro přidání pizzy do košíku
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pizzaId = $_POST['pizza_id'];
            //$cartManager = new CartManager($this->db);
            //$cartManager->addToCart($pizzaId);
            // Přesměrování zpět na stejnou stránku po přidání
            header("Location: /"); // Přesměrování na domovskou stránku
            exit;
        }

        // Zahrnutí záhlaví a patičky
        include __DIR__ . '/../layouts/header.php';
        include __DIR__ . '/../views/pizzas/index.php'; // Zahrnout pohled
        include __DIR__ . '/../layouts/footer.php';
    }
}
