<?php

namespace App\Models;

class CartManager {
    private $cart;

    public function __construct() {
        // Initialize the cart from the session or create a new cart array
        $this->cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    }

    public function getCartItems() {
        return $this->cart;
    }

    public function updateQuantity($id, $action) {
        if (isset($this->cart[$id])) {
            if ($action === 'increase') {
                $this->cart[$id]['quantity']++;
            } elseif ($action === 'decrease' && $this->cart[$id]['quantity'] > 1) {
                $this->cart[$id]['quantity']--;
            }
            $_SESSION['cart'] = $this->cart; // Update session
        }
    }

    public function removeFromCart($id) {
        if (isset($this->cart[$id])) {
            unset($this->cart[$id]);
            $_SESSION['cart'] = $this->cart; // Update session
        }
    }

    public function getTotalPrice() {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
