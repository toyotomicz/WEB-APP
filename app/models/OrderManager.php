<?php
namespace App\Models;

use PDO;
use Exception;

class OrderManager {
    private $db;

    public function __construct(MyDatabase $db) {
        $this->db = $db;
    }

    /**
     * Získá seznam objednávek podle stavu.
     *
     * @param string $statusFilter Filtr stavu (např. 'all', 'v_priprave', 'dokonceno')
     * @return array
     * @throws Exception Pokud dojde k chybě během dotazu
     */
    public function getOrdersByStatus(string $statusFilter = 'all'): array {
        $query = "
            SELECT 
                o.id AS order_id, 
                o.customer_id, 
                GROUP_CONCAT(CONCAT(p.name, ' (x', oi.quantity, ')') SEPARATOR ', ') AS items, 
                o.status
            FROM orders o
            JOIN order_items oi ON o.id = oi.order_id
            JOIN pizza_types p ON oi.pizza_type_id = p.id";
        
        $params = [];

        if ($statusFilter === 'v_priprave') {
            $query .= " WHERE o.status = :status";
            $params[':status'] = 'V přípravě';
        } elseif ($statusFilter === 'dokonceno') {
            $query .= " WHERE o.status = :status";
            $params[':status'] = 'Dokončeno';
        }

        $query .= "
            GROUP BY o.id, o.customer_id, o.status
            ORDER BY o.id DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Nastaví objednávku jako dokončenou.
     *
     * @param int $orderId ID objednávky
     * @return bool
     * @throws Exception Pokud dojde k chybě při aktualizaci
     */
    public function markAsCompleted(int $orderId): bool {
        $sql = "UPDATE orders SET status = 'Dokončeno' WHERE id = :order_id";
        $stmt = $this->db->prepare($sql);

        if (!$stmt->execute([':order_id' => $orderId])) {
            throw new Exception("Nepodařilo se aktualizovat stav objednávky.");
        }

        return true;
    }

    /**
     * Vytvoří novou objednávku.
     *
     * @param int $userId ID uživatele
     * @param array $cartItems Položky v košíku
     * @param float $totalPrice Celková cena (momentálně nevyužívána)
     * @return int ID nově vytvořené objednávky
     * @throws Exception Pokud dojde k chybě během transakce
     */
    public function createOrder(int $userId, array $cartItems, float $totalPrice): int {
        try {
            $this->db->beginTransaction();

            $sql = "INSERT INTO orders (customer_id, status) VALUES (:user_id, 'V přípravě')";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':user_id' => $userId]);

            $orderId = (int) $this->db->lastInsertId();

            $sqlItems = "INSERT INTO order_items (order_id, pizza_type_id, quantity) VALUES (:order_id, :pizza_type_id, :quantity)";
            $stmtItems = $this->db->prepare($sqlItems);

            foreach ($cartItems as $item) {
                $stmtItems->execute([
                    ':order_id' => $orderId,
                    ':pizza_type_id' => $item['pizza_type_id'],
                    ':quantity' => $item['quantity']
                ]);
            }

            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new Exception("Nepodařilo se vytvořit objednávku: " . $e->getMessage());
        }
    }
}
?>
