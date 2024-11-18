<?php
namespace App\Controllers;

use App\Models\MyDatabase;
use App\Models\OrderManager;
use App\Models\ChefManager;
use App\Models\Session;

use App\Config\Settings;

class ChefController {
    private $db;
    private $orderManager;
    private $chefManager;
    private $session;

    public function __construct() {
        $this->db = new MyDatabase(Settings::DB_SERVER, Settings::DB_NAME, Settings::DB_USER, Settings::DB_PASS);
        $this->orderManager = new OrderManager($this->db);
        $this->chefManager = new ChefManager($this->db);
        $this->session = new Session();
    }

    public function listOrders() {
        $statusFilter = $_GET['filter'] ?? 'all';
        $orders = $this->orderManager->getOrdersByStatus($statusFilter);
        
        include __DIR__ . '/../layouts/header.php';
        include __DIR__ . '/../views/orders/orders.php'; 
        include __DIR__ . '/../layouts/footer.php';
    }

    public function completeOrder() {
        if (isset($_POST['order_id'])) {
            $orderId = $_POST['order_id'];
            $this->orderManager->markAsCompleted($orderId);
            $_SESSION['message'] = "Objednávka $orderId byla označena jako dokončená.";
            header("Location: orders");
            exit;
        }
        echo "Chybí ID objednávky.";
    }
    
    public function showAddChefForm() {
        // Zobrazí formulář pro přidání kuchaře
        require 'views/chef/addChef.php';
    }

    public function addChef() {
        // Ověří, zda jsou všechna potřebná data poslána
        if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $result =  $this->chefManager->createChef($username, $email, $password);

            if ($result) {
                $_SESSION['message'] = 'Kuchař byl úspěšně přidán!';
            } else {
                $_SESSION['error'] = 'Nepodařilo se přidat kuchaře. Zkuste to znovu.';
            }
            header('Location: index.php?controller=chef&action=showAddChefForm');
            exit;
        }
    }
}
