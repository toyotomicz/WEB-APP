<?php
namespace App\Controllers;

use App\Models\MyDatabase;
use App\Models\PizzaManager;
use App\Models\CartManager;
use App\Config\Settings;

class PizzaController {
    private $db;
    private $cartManager;
    private $pizzaManager;
    private $uploadDir;
    private $viewsPath;

    public function __construct() {
        $this->db = new MyDatabase(Settings::DB_SERVER, Settings::DB_NAME, Settings::DB_USER, Settings::DB_PASS);
        $this->cartManager = new CartManager($this->db);
        $this->pizzaManager = new PizzaManager($this->db);
        
        // Define paths relative to the app directory
        $this->uploadDir = dirname(dirname(__DIR__)) . '/uploads/';  // Goes up to root and then into uploads
        $this->viewsPath = dirname(__DIR__) . '/views/';
    }

    public function index() {
        $pizzas = $this->pizzaManager->getPizzas();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pizzaId = $_POST['pizza_id'] ?? null;
            $pizzaName = $_POST['pizza_name'] ?? null;
            $pizzaPrice = $_POST['pizza_price'] ?? null;
            $pizzaImage = $_POST['pizza_image'] ?? null;

            if ($pizzaId && $pizzaName && $pizzaPrice && $pizzaImage) {
                $this->cartManager->addToCart($pizzaId, $pizzaName, $pizzaPrice, $pizzaImage);
                header("Location: /web-app/semestralka/public/index.php/");
                exit;
            }
        }

        require dirname(__DIR__) . '/layouts/header.php';
        require $this->viewsPath . 'pizzas/index.php';
        require dirname(__DIR__) . '/layouts/footer.php';
    }

    public function showAddPizzaForm() {
        require dirname(__DIR__) . '/layouts/header.php';
        require $this->viewsPath . 'pizzas/add_pizza.php';
        require dirname(__DIR__) . '/layouts/footer.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->showAddPizzaForm();
            return;
        }

        $name = $_POST['name'] ?? '';
        $price = $_POST['price'] ?? 0;
        $image = $_FILES['image'] ?? null;

        $error = null;

        // Basic validation
        if (empty($name) || empty($price)) {
            $error = "Název a cena jsou povinné položky.";
        }

        // Image validation
        if (!$image || $image['error'] !== UPLOAD_ERR_OK) {
            $error = "Chyba při nahrávání obrázku.";
        }

        if (!$error) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            $realMimeType = mime_content_type($image['tmp_name']);
            
            if (!in_array($realMimeType, $allowedTypes) || $image['size'] > 2 * 1024 * 1024) {
                $error = "Neplatný formát nebo velikost souboru (max 2MB).";
            }
        }

        if ($error) {
            require $this->viewsPath . 'pizzas/add_pizza.php';
            return;
        }

        // Create upload directory if it doesn't exist
        if (!is_dir($this->uploadDir)) {
            if (!mkdir($this->uploadDir, 0775, true)) {
                $error = "Nepodařilo se vytvořit adresář pro uploady.";
                require $this->viewsPath . 'pizzas/add_pizza.php';
                return;
            }
        }

        // Generate unique filename
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $imagePath = $this->uploadDir . $filename;

        // Move uploaded file
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            $error = "Nepodařilo se uložit soubor. Zkontrolujte oprávnění složky.";
            require $this->viewsPath . 'pizzas/add_pizza.php';
            return;
        }

        // Save to database
        if ($this->pizzaManager->addPizza($name, $price, $filename)) {
            header('Location: /web-app/semestralka/public/index.php/menu');
            exit;
        } else {
            // If database save fails, delete the uploaded file
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $error = "Chyba při ukládání do databáze.";
            require $this->viewsPath . 'pizzas/add_pizza.php';
        }
    }
}