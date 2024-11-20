<?php
namespace App\Models;

use PDO;
use App\Models\MyDatabase;

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
                'pizza_type_id' => htmlspecialchars((string)$pizzaId, ENT_QUOTES, 'UTF-8'),
                'name' => htmlspecialchars($pizzaName, ENT_QUOTES, 'UTF-8'),
                'price' => $pizzaPrice,
                'image' => htmlspecialchars($pizzaImage, ENT_QUOTES, 'UTF-8'),
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

    /**
     * Vrací položky košíku jako pole.
     *
     * @return array
     */
    public function getCartItemsAsArray(): array {
        $cartItems = $this->session->readSession('cart') ?? [];
        $itemsArray = [];
        foreach ($cartItems as $item) {
            $itemsArray[] = [
                'name' => htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'),
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ];
        }
        return $itemsArray;
    }

    /**
     * Vrátí uživatelské ID podle jména.
     *
     * @param string $username Uživatelské jméno
     * @return int|null ID uživatele nebo null
     */
    public function getUserIdByUsername(string $username): ?int {
        // Ošetření vstupu a použití připraveného dotazu
        $query = "SELECT id FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['id'] : null;
    }
}
?>
