<?php
include "cart_manager.php";

$cartManager = new CartManager();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_id'])) {
        $cartManager->updateQuantity($_POST['update_id'], $_POST['action']);
    }
    if (isset($_POST['remove_id'])) {
        $cartManager->removeFromCart($_POST['remove_id']);
    }
}

$cartItems = $cartManager->getCartItems();
$totalPrice = $cartManager->getTotalPrice();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Košík</title>
    <link rel="icon" type="image/x-icon" href="images/pizza.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">       
</head>
<body>

<?php include "navbar.php"; ?>

<div class="container cart-container">
    <h2 class="text-center mb-4">Váš Košík</h2>

    <?php if (empty($cartItems)): ?>
        <div class="alert alert-warning" role="alert">
            Váš košík je prázdný.
        </div>
    <?php else: ?>
        <?php foreach ($cartItems as $id => $item): ?>
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
            <h4>Celková cena: <?php echo number_format($totalPrice, 2); ?> Kč</h4>
        </div>
    <?php endif; ?>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
