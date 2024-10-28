<?php

session_start(); // Zahájení relace pro správu uživatelského přihlášení

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        include $file;
    }
});


use App\Controllers\PizzaController;
use App\Controllers\AuthController;
use App\Controllers\CartController;
use App\Controllers\OrderController;
use App\Controllers\UserController;

// Rozpoznání požadavku
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Split the path by '/' and get the last element
$segments = explode('/', $uri);
$lastSegment = end($segments);

// Optionally, you can trim any leading or trailing whitespace
$uri = trim($lastSegment);

$uri = "/". $uri;

// Jednoduchý router
switch ($uri) {
    case '/':
        $menuController = new PizzaController();
        $menuController->index();
        break;
    
    case '/menu':
        $menuController = new PizzaController();
        $menuController->index();
        break;

    case '/register':
        $userController = new AuthController();
        $userController->register();
        break;

    case '/login':
        $userController = new AuthController();
        $userController->login();
        break;

    case '/cart':
        $orderController = new CartController();
        $orderController->cart();
        break;
    // case '/orders':
    //     $orderController = new OrderController();
    //     $orderController->showOrders();
    //     break;

    // case '/add-cook':
    //     $userController = new UserController();
    //     $userController->addCook();
    //     break;

    // case '/add-admin':
    //     $userController = new UserController();
    //     $userController->addAdmin();
    //     break;

    // case '/logout':
    //     $userController = new UserController();
    //     $userController->logout();
    //     break;

    default:
        echo "404 - Stránka nenalezena.";
        break;
}
?>