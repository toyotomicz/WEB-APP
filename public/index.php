<?php

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        include $file;
    }
});


use App\Controllers\PizzaController;
use App\Controllers\AuthController;
use App\Controllers\CartController;
use App\Controllers\ChefController;
use App\Controllers\UserController;
use App\Controllers\AdminController;
use App\Models\OrderManager;

// Rozpoznání požadavku
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Split the path by '/' and get the last element
$segments = explode('/', $uri);
$lastSegment = end($segments);

// Optionally, you can trim any leading or trailing whitespace
$uri = trim($lastSegment);

$uri = "/". $uri;

// Definování směrovače jako asociativního pole
$routes = [
    ' ' => [PizzaController::class, 'index'],
    '/' => [PizzaController::class, 'index'],
    '/menu' => [PizzaController::class, 'index'],
    '/register' => [AuthController::class, 'register'],
    '/login' => [AuthController::class, 'login'],
    '/cart' => [CartController::class, 'viewCart'],
    '/orders' => [ChefController::class, 'listOrders'],
    '/add-cook' => [AdminController::class, 'addCook'],
    '/add-admin' => [AdminController::class, 'addAdmin'],
    '/logout' => [AuthController::class, 'logout'],
    '/add-pizza' => [PizzaController::class, 'showAddPizzaForm'], // Zobrazení formuláře
    '/add-new-pizza' => [PizzaController::class, 'create'],      // Zpracování formuláře
    '/cart-submit' => [CartController::class, 'submit'],
    '/cart-remove' => [CartController::class, 'removeItem'],
    '/cart-clear' => [CartController::class, 'clearCart'],
    '/mark-as-completed' => [ChefController::class, 'completeOrder'],
];

// Ověření, zda je URI definováno v routeru, a spuštění odpovídající metody
if (array_key_exists($uri, $routes)) {
    [$controller, $method] = $routes[$uri];
    $controllerInstance = new $controller();

    if (method_exists($controllerInstance, $method)) {
        // Ověříme, zda je požadavek typu POST pro odeslání formuláře na /pizza/create
        if ($uri === '/pizza/create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controllerInstance->$method($_POST); // Předáme data z POST požadavku
        } else {
            $controllerInstance->$method();
        }
    } else {
        echo "404 - Metoda nenalezena.";
    }
} else {
    echo "404 - Stránka nenalezena.";
}
