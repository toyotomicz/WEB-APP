<?php
session_start();

// Předdefinované pizzy s obrázky a popisy
$pizzas = [
    ['id' => 1, 'name' => 'Margarita', 'price' => 150, 'description' => 'Klasická pizza s rajčatovým základem a sýrem.', 'image' => 'pizza-1.jpg'],
    ['id' => 2, 'name' => 'Pepperoni', 'price' => 180, 'description' => 'Pizza s pikantním salámem pepperoni a sýrem.', 'image' => 'pizza-2.jpg'],
    ['id' => 3, 'name' => 'Funghi', 'price' => 170, 'description' => 'Pizza s houbami a sýrem na rajčatovém základu.', 'image' => 'pizza-3.jpg']
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
            'quantity' => 1
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

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výběr Pizzy</title>
    <link rel="icon" type="image/x-icon" href="pizza.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .pizza-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .pizza-card {
            width: 30%;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            padding: 15px;
            text-align: center;
        }
        .pizza-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .pizza-card h3 {
            margin-top: 15px;
            font-size: 1.5em;
        }
        .pizza-card p {
            margin: 10px 0;
        }
    </style>
</head>
<body>

<!-- Navigační lišta -->
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
