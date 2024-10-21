<?php
include "PizzaManager.php";
include "CartManager.php";

$pizzaManager = new PizzaManager();
$pizzas = $pizzaManager->getPizzas();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pizzaId = $_POST['pizza_id'];
    $cartManager = new CartManager();
    $cartManager->addToCart($pizzaId);
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výběr Pizzy</title>
    <link rel="icon" type="image/x-icon" href="images/pizza.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "navbar.php"; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Vyberte si pizzu</h2>

    <div class="pizza-container">
        <?php foreach ($pizzas as $pizza): ?>
        <div class="pizza-card">
            <img src="images/<?php echo $pizza['image']; ?>" alt="<?php echo htmlspecialchars($pizza['name']); ?>">
            <h3><?php echo htmlspecialchars($pizza['name']); ?></h3>
            <p><?php echo htmlspecialchars($pizza['description']); ?></p>
            <p><strong><?php echo number_format($pizza['price'], 2); ?> Kč</strong></p>
            <form method="post" action="">
                <input type="hidden" name="pizza_id" value="<?php echo $pizza['id']; ?>">
                <button type="submit" class="btn btn-primary btn-block">Objednat</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
