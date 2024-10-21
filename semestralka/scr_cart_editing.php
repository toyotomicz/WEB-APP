<?php
session_start();

// Zpracování odstranění pizzy z košíku
if (isset($_POST['remove_id'])) {
    $remove_id = $_POST['remove_id'];
    unset($_SESSION['cart'][$remove_id]);
    header('Location: cart.php');
    exit;
}

// Zpracování zvýšení nebo snížení množství
if (isset($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $action = $_POST['action'];

    if ($action == 'increase') {
        $_SESSION['cart'][$update_id]['quantity'] += 1;
    } elseif ($action == 'decrease') {
        $_SESSION['cart'][$update_id]['quantity'] -= 1;
    }

    // Odstranit položku, pokud je množství 0
    if ($_SESSION['cart'][$update_id]['quantity'] <= 0) {
        unset($_SESSION['cart'][$update_id]);
    }

    header('Location: cart.php');
    exit;
}

// Počet pizz v košíku
$cart_count = 0;
foreach ($_SESSION['cart'] as $item) {
    $cart_count += $item['quantity'];
}
?>