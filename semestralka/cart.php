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

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Košík</title>
    <link rel="icon" type="image/x-icon" href="pizza.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .cart-container {
            margin: 20px auto;
            max-width: 800px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        .cart-item img {
            width: 100px;
            height: auto;
            margin-right: 15px;
            border-radius: 8px;
        }
        .quantity-control {
            display: flex;
            align-items: center;
            margin-right: auto;
        }
        .quantity-control button {
            border: none;
            background-color: transparent;
            font-size: 1.5em;
        }
        .quantity-display {
            width: 50px;
            text-align: center;
            font-size: 1.2em;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            margin: 0 5px;
        }
        .remove-button {
            border: none;
            background-color: transparent;
            font-size: 1.5em;
            cursor: pointer;
            color: red;
        }
    </style>
</head>
<body>

<!-- Navigační lišta -->
<?php include "navbar.php"; ?>

<div class="container cart-container">
    <h2 class="text-center mb-4">Váš Košík</h2>

    <?php if (empty($_SESSION['cart'])): ?>
        <div class="alert alert-warning" role="alert">
            Váš košík je prázdný.
        </div>
    <?php else: ?>
        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
        <div class="cart-item">
            <img src="images/<?php echo $item['image']; ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
            <div class="quantity-control">
                <form method="post" action="">
                    <input type="hidden" name="update_id" value="<?php echo $id; ?>">
                    <button type="submit" name="action" value="decrease">-</button>
                    <input type="text" class="quantity-display" value="<?php echo $item['quantity']; ?>" readonly>
                    <button type="submit" name="action" value="increase">+</button>
                </form>
            </div>
            <div class="remove-button">
                <form method="post" action="">
                    <input type="hidden" name="remove_id" value="<?php echo $id; ?>">
                    <button type="submit" style="border: none; background: none; color: red; cursor: pointer;">
                        🗑️
                    </button>
                </form>
            </div>
            <div>
                <strong><?php echo htmlspecialchars($item['name']); ?></strong> - <?php echo number_format($item['price'] * $item['quantity'], 2); ?> Kč
            </div>
        </div>
        <?php endforeach; ?>
        <div class="text-right">
            <h4>Celková cena: <?php echo number_format(array_sum(array_column($_SESSION['cart'], 'price')), 2); ?> Kč</h4>
        </div>
    <?php endif; ?>
</div>

<!-- Footer -->
<footer>
    <p>Adresa: Pizzerie u Hvězdy, Hlavní 123, Praha 1</p>
    <p>Telefon: +420 123 456 789</p>
</footer>

<!-- Local Bootstrap JS and jQuery -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
