<?php
class CartManager {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function addToCart($pizzaId, $quantity = 1) {
        if (isset($_SESSION['cart'][$pizzaId])) {
            $_SESSION['cart'][$pizzaId]['quantity'] += $quantity;
        } else {
            $pizzas = (new PizzaManager())->getPizzas();
            foreach ($pizzas as $pizza) {
                if ($pizza['id'] == $pizzaId) {
                    $_SESSION['cart'][$pizzaId] = ['name' => $pizza['name'], 'price' => $pizza['price'], 'quantity' => $quantity, 'image' => $pizza['image']];
                    break;
                }
            }
        }
    }

    public function updateQuantity($pizzaId, $action) {
        if (isset($_SESSION['cart'][$pizzaId])) {
            if ($action == 'increase') {
                $_SESSION['cart'][$pizzaId]['quantity']++;
            } elseif ($action == 'decrease' && $_SESSION['cart'][$pizzaId]['quantity'] > 1) {
                $_SESSION['cart'][$pizzaId]['quantity']--;
            }
        }
    }

    public function removeFromCart($pizzaId) {
        unset($_SESSION['cart'][$pizzaId]);
    }

    public function getTotalPrice() {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function getCartItems() {
        return $_SESSION['cart'];
    }
}
?>
