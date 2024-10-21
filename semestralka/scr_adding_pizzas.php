<?php
session_start();

// Předdefinované pizzy s obrázky a popisy
$pizzas = [
    ['id' => 1, 'name' => 'Margarita', 'price' => 150, 'description' => 'Klasická pizza s rajčatovým základem a sýrem.', 'image' => 'pizza-1.jpg'],
    ['id' => 2, 'name' => 'Pepperoni', 'price' => 180, 'description' => 'Pizza s pikantním salámem pepperoni a sýrem.', 'image' => 'pizza-2.jpg'],
    ['id' => 3, 'name' => 'Funghi', 'price' => 170, 'description' => 'Pizza s houbami a sýrem na rajčatovém základu.', 'image' => 'pizza-5.jpg']
];

// Inicializace košíku
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Přidání pizzy do košíku
if (isset($_POST['pizza_id'])) {
    $pizza_id = $_POST['pizza_id'];
    $pizza = $pizzas[$pizza_id - 1];

    // Přidání nebo zvýšení množství pizzy v košíku
    if (isset($_SESSION['cart'][$pizza_id])) {
        $_SESSION['cart'][$pizza_id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$pizza_id] = [
            'name' => $pizza['name'],
            'price' => $pizza['price'],
            'quantity' => 1,
            'image' => $pizza['image']
        ]; 
    }
    header('Location: index.php');
    exit;
}

// Počet pizz v košíku
$cart_count = 0;
foreach ($_SESSION['cart'] as $item) {
    $cart_count += $item['quantity'];
}
?>