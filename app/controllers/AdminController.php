<?php
namespace App\Controllers;

use App\Models\AdminManager;
use App\Models\MyDatabase;
use App\Models\Session;
use App\Config\Settings;

class AdminController {
    private $db;
    private $session;

    public function __construct() {
        // Initialize the database connection
        try {
            $this->db = new MyDatabase(Settings::DB_SERVER, Settings::DB_NAME, Settings::DB_USER, Settings::DB_PASS);
        } catch (\Exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }

        // Start session management
        $this->session = new Session();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function addAdmin() {
        // Check if required data is provided
        include __DIR__ . '/../layouts/header.php';
        include __DIR__ . '/../views/management/add_admin.php';
        include __DIR__ . '/../layouts/footer.php';

        if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
            $username = trim($_POST['username']);
            $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
            $password = trim($_POST['password']);

            // Basic validation
            if (!$email || empty($username) || empty($password)) {
                $_SESSION['error'] = 'Please provide valid username, email, and password.';
                exit;
            }
            
            // Use AdminManager to add the admin to the database
            $adminManager = new AdminManager($this->db);
            $result = $adminManager->createAdmin($username, $email, $password);

            if ($result) {
                $_SESSION['message'] = 'Admin was successfully added!';
                header("Location: add-admin"); // Redirect to a success page
            } else {
                $_SESSION['error'] = 'Failed to add admin. Please try again.';
            }
            exit;
        } else {
            $_SESSION['error'] = 'Please fill out all required fields.';
            exit;
        }
    }

    public function addCook() {
        // Check if required data is provided
        include __DIR__ . '/../layouts/header.php';
        include __DIR__ . '/../views/management/add_cook.php';
        include __DIR__ . '/../layouts/footer.php';

        if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
            $username = trim($_POST['username']);
            $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
            $password = trim($_POST['password']);

            // Basic validation
            if (!$email || empty($username) || empty($password)) {
                $_SESSION['error'] = 'Please provide valid username, email, and password.';
                exit;
            }
            
            // Use AdminManager to add the admin to the database
            $adminManager = new AdminManager($this->db);
            $result = $adminManager->createCook($username, $email, $password);

            if ($result) {
                $_SESSION['message'] = 'Cook was successfully added!';
                header("Location: add-cook"); // Redirect to a success page
            } else {
                $_SESSION['error'] = 'Failed to add admin. Please try again.';
            }
            exit;
        } else {
            $_SESSION['error'] = 'Please fill out all required fields.';
            exit;
        }
    }
}
