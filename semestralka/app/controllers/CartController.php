<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MySession;
use App\Models\MyDatabase;
use App\Models\PizzaManager;
use App\Models\CartManager;
use App\Config\Settings;


class CartController {
    private $cartManager;

    public function __construct() {
        $this->cartManager = new CartManager();
    }

    public function cart() {
        // Fetch cart items from the CartManager
        $cartItems = $this->cartManager->getCartItems();
        $totalPrice = $this->cartManager->getTotalPrice();

        // Load the view and pass the cart data
        include __DIR__ . '/../layouts/header.php';
        include __DIR__ . '/../views/orders/cart.php'; // Zahrnout pohled
        include __DIR__ . '/../layouts/footer.php';
    }

    public function update() {
        // Check for POST requests to update quantity
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['update_id'])) {
                $this->cartManager->updateQuantity($_POST['update_id'], $_POST['action']);
            }
            if (isset($_POST['remove_id'])) {
                $this->cartManager->removeFromCart($_POST['remove_id']);
            }
        }
        // Redirect back to the cart view after processing
        header('Location: index.php/cart'); // Change according to your routing
        exit();
    }
}