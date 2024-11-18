<?php
namespace App\Controllers;

use App\Models\CartManager;

class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        //$userModel = new User($this->db);
        //$users = $userModel->getAllUsers();
        include '../app/views/users/index.php';
    }

    public function register() {
        // Zpracování registrace uživatele
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Získání dat z formuláře
            $name = $_POST['name'];
            $roleId = $_POST['role_id'];

            //$userModel = new User($this->db);
            //$userModel->addUser($name, $roleId);
            header("Location: /index.php?controller=user&action=index");
        }

        include '../app/views/users/registration.php';
    }
}
?>
