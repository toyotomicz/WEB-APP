<?php
namespace App\Controllers;

use App\Models\CartManager;
use App\Models\OrderManager;
use App\Models\MyDatabase;

use App\Config\Settings;
use Exception;

class CartController {
    private $cartManager;
    private $orderManager;
    private $db;
    private const VIEWS_PATH = __DIR__ . '/../views/';
    private const LAYOUTS_PATH = __DIR__ . '/../layouts/';

    public function __construct() {
        
        $this->db = new MyDatabase(Settings::DB_SERVER, Settings::DB_NAME, Settings::DB_USER, Settings::DB_PASS);

        $this->cartManager = new CartManager($this->db);
        $this->orderManager = new OrderManager($this->db);
    }

    /**
     * Zobrazí položky v košíku.
     */
    public function viewCart() {
        try {
            $cartItems = $this->cartManager->getCartItems();
            $totalPrice = $this->calculateTotalPrice($cartItems);
            
            require self::LAYOUTS_PATH . 'header.php';
            require self::VIEWS_PATH . 'orders/cart.php';
            require self::LAYOUTS_PATH . 'footer.php';
        } catch (\Exception $e) {
            // Log error and show user-friendly message
            error_log("Cart view error: " . $e->getMessage());
            $_SESSION['error'] = 'Došlo k chybě při načítání košíku.';
            header("Location: ../index.php/error");
            exit;
        }
    }

    /**
     * Odebere položku z košíku.
     *
     * @param int $pizzaId ID pizzy k odstranění.
     */
    public function removeItem() {
        if (isset($_POST['pizza_id'])) {
            $pizza_id = trim($_POST['pizza_id']);
            
            $this->cartManager->removeFromCart($pizza_id);

            $_SESSION['success'] = 'Položka byla úspěšně odstraněna z košíku.';

            header("Location: " . BASEURL . "index.php/cart");
        }         
        exit;
    }

    /**
     * Vyprázdní celý košík.
     */
    public function clearCart() {
        try {
            $this->cartManager->clearCart();
            $_SESSION['success'] = 'Košík byl úspěšně vyprázdněn.';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Došlo k chybě při vyprazdňování košíku.';
        }
        
        header("Location: " . BASEURL . "index.php/cart");
        exit;
    }

    /**
     * Vypočítá celkovou cenu položek v košíku.
     * 
     * @param array $cartItems
     * @return float
     */
    private function calculateTotalPrice(array $cartItems): float {
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function submit() {
        // Check if the user session and cart data are set
        if (isset($_SESSION['user'], $_SESSION['cart'])) {
            $username = $_SESSION['user']['username']; // Get the username from session
            $cartItems = $_SESSION['cart'];
            $totalPrice = 0;
    
            // Validate the cart items
            if (empty($cartItems)) {
                $_SESSION['error'] = 'Cart is empty. Please add items to your cart.';
                header("Location: chybakosik");
                exit;
            }
    
            // Fetch the user ID based on username
            $userId = $this->cartManager->getUserIdByUsername($username); 
            if (!$userId) {
                $_SESSION['error'] = 'User not found. Please log in again.';
                header("Location: " . var_dump($_SESSION['user']['username']));
                exit;
            }
    
            // Calculate total price based on cart data
            foreach ($cartItems as $item) {
                if (isset($item['price'], $item['quantity'])) {
                    $totalPrice += $item['price'] * $item['quantity'];
                } else {
                    $_SESSION['error'] = 'Invalid item data in cart. Please refresh and try again.';
                    header("Location: chyba2");
                    exit;
                }
            }

            try {
                $orderId = $this->orderManager->createOrder($userId, $cartItems, $totalPrice);
    
                if ($orderId) {
                    $_SESSION['message'] = 'Order was successfully created!';
                    // Clear cart after successful order
                    unset($_SESSION['cart']);
                    header("Location: cart");
                    exit;
                } else {
                    $_SESSION['error'] = 'Failed to create order. Please try again.';
                    header("Location: chyba4");
                }
            } catch (Exception $e) {
                $_SESSION['error'] = 'Order creation failed: ' . $e->getMessage();
                header("Location: chyba3" . $e->getMessage());
                exit;
            }
        } else {
            $_SESSION['error'] = 'Please log in and add items to the cart.';
        }
    
        header("Location: chyba5");
        exit;
    }    
}