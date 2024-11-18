<?php
namespace App\Models;

use PDO;
use Exception;
use App\Config\Settings;

class OrderManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getOrdersByStatus($statusFilter = 'all') {
        $query = "
            SELECT 
                o.id AS order_id, 
                o.customer_id, 
                GROUP_CONCAT(CONCAT(p.name, ' (x', oi.quantity, ')') SEPARATOR ', ') AS items, 
                o.status
            FROM orders o
            JOIN order_items oi ON o.id = oi.order_id
            JOIN pizza_types p ON oi.pizza_type_id = p.id";
    
        if ($statusFilter === 'v_priprave') {
            $query .= " WHERE o.status = 'V přípravě'";
        } elseif ($statusFilter === 'dokonceno') {
            $query .= " WHERE o.status = 'Dokončeno'";
        }
    
        $query .= "
            GROUP BY o.id, o.customer_id, o.status
            ORDER BY o.id DESC"; // Řazení podle nejvyššího ID
    
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    public function markAsCompleted($orderId) {
        $sql = "UPDATE orders SET status = 'Dokončeno' WHERE id = :order_id";
        $params = [':order_id' => $orderId];
    
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute($params);
    
        if (!$result) {
            throw new Exception("Nepodařilo se aktualizovat stav objednávky.");
        }
    
        return true;
    }

    public function createOrder($userId, $cartItems, $totalPrice) {
        try {
            $this->db->beginTransaction();
    
            $sql = "INSERT INTO orders (customer_id, status) VALUES (:userId, 'V přípravě')";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
    
            $orderId = $this->db->lastInsertId();
    
            $sqlItems = "INSERT INTO order_items (order_id, pizza_type_id, quantity) VALUES (:orderId, :pizzaTypeId, :quantity)";
            $stmtItems = $this->db->prepare($sqlItems);
            foreach ($cartItems as $item) {
                $stmtItems->bindParam(':orderId', $orderId, PDO::PARAM_INT);
                $stmtItems->bindParam(':pizzaTypeId', $item['pizza_type_id'], PDO::PARAM_INT);
                $stmtItems->bindParam(':quantity', $item['quantity'], PDO::PARAM_INT);
                $stmtItems->execute();
            }
    
            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new Exception("Nepodařilo se vytvořit objednávku: " . $e->getMessage());
        }
    }
}
