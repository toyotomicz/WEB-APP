<?php
namespace App\Models;

use App\Models\MyDatabase;
use PDO;

class CartManager {
    private $session;
    private $db;
    
    public function __construct($db) {
        $this->session = new Session();
        $this->db = $db;
    }

    /**
     * Přidá pizzu do košíku.
     *
     * @param int $pizzaId ID pizzy
     * @param string $pizzaName Název pizzy
     * @param float $pizzaPrice Cena pizzy
     * @param string $pizzaImage Obrázek pizzy
     * @throws \InvalidArgumentException Pokud jsou neplatné vstupní parametry
     */
    public function addToCart(int $pizzaId, string $pizzaName, float $pizzaPrice, string $pizzaImage): void {
        if ($pizzaPrice < 0) {
            throw new \InvalidArgumentException('Cena nemůže být záporná.');
        }

        $cart = $this->session->readSession('cart') ?? [];
        
        if (isset($cart[$pizzaId])) {
            $cart[$pizzaId]['quantity']++;
        } else {
            $cart[$pizzaId] = [
                'pizza_type_id' => htmlspecialchars($pizzaId),
                'name' => htmlspecialchars($pizzaName),
                'price' => $pizzaPrice,
                'image' => htmlspecialchars($pizzaImage),
                'quantity' => 1
            ];
        }

        $this->session->addSession('cart', $cart);
    }

    /**
     * @return array
     */
    public function getCartItems(): array {
        return $this->session->readSession('cart') ?? [];
    }

    /**
     * Vyprázdní košík.
     */
    public function clearCart(): void {
        $this->session->removeSession('cart');
    }

    /**
     * Odebere položku z košíku.
     *
     * @param int $pizzaId
     */
    public function removeFromCart(int $pizzaId): void {
        $cart = $this->session->readSession('cart') ?? [];
        if (isset($cart[$pizzaId])) {
            unset($cart[$pizzaId]);
            $this->session->addSession('cart', $cart);
        }
    }

    public function getCartItemsAsArray(): array {
        $cartItems = $this->session->readSession('cart') ?? [];
        $itemsArray = [];
        foreach ($cartItems as $item) {
            $itemsArray[] = [
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ];
        }
        return $itemsArray;
    }

    // Helper function to get user ID by username
    public function getUserIdByUsername($username) {
        $query = "SELECT id FROM users WHERE username = '$username'";
        $result = $this->db->query($query);
        
        if ($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row['id'];
        }
    
        return null;
    }
}
?>
