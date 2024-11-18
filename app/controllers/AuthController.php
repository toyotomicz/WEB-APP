<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Session;

use App\Config\Settings;

class AuthController {
    private $userModel;
    private $session;

    public function __construct() {
        // Create PDO instance
        $pdo = new \PDO(
            "mysql:host=" . Settings::DB_SERVER . ";dbname=" . Settings::DB_NAME,
            Settings::DB_USER,
            Settings::DB_PASS
        );
        $this->userModel = new UserModel($pdo);
        $this->session = new Session();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Validate passwords
            if ($password !== $confirm_password) {
                $_SESSION['error_message'] = "Hesla se neshodují.";
                header("Location: /web-app/semestralka/public/index.php/register");
                exit();
            }

            if (strlen($password) < 3) {
                $_SESSION['error_message'] = "Heslo musí mít alespoň 3 znaky.";
                header("Location: /web-app/semestralka/public/index.php/register");
                exit();
            }

            // Check if username already exists
            if ($this->userModel->getUserByUsername($username)) {
                $_SESSION['error_message'] = "Uživatelské jméno již existuje.";
                header("Location: /web-app/semestralka/public/index.php/register");
                exit();
            }

            // Attempt to register the user
            if ($this->userModel->registerUser($username, $email, $password)) {
                // Registration successful, redirect to login page
                header("Location: /web-app/semestralka/public/index.php/login");
                exit();
            } else {
                $_SESSION['error_message'] = "Registrace selhala.";
                header("Location: /web-app/semestralka/public/index.php/register");
                exit();
            }
        }

        include __DIR__ . '/../layouts/header.php';
        include __DIR__ . '/../views/auth/register.php';
        include __DIR__ . '/../layouts/footer.php';
        
    }

    public function login() {
        // Create an instance of MySession
        //$session = new MySession();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
    
            // Attempt to login
            $user = $this->userModel->loginUser($username, $password);
    
            if ($user) {
                // Store user information in session
                $this->session->addSession('user', [
                    'username' => $user['username'], // Assuming 'username' is a field in your user data
                    'role' => $user['role_id'] // Assuming 'role_id' is present in the user data
                ]);
    
                // Redirect to the menu page
                header("Location: /web-app/semestralka/public/index.php/menu");
                exit();
            } else {
                // Store error message in session
                $this->session->addSession('error_message', "Neplatné přihlašovací údaje.");
                header("Location: /web-app/semestralka/public/index.php/login");
                exit();
            }
        }
    
        // Include header and footer
        include __DIR__ . '/../layouts/header.php';
        include __DIR__ . '/../views/auth/login.php'; // Include the view
        include __DIR__ . '/../layouts/footer.php';
    }
    
    

    public function logout() {        
        // Destroy the session
        $this->session->destroySession();
    
        // Redirect to the login page
        header("Location: /web-app/semestralka/public/index.php/login"); // or home page
        exit();
    }
    
}
