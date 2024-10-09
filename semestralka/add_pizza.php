<?php
session_start();

// Zkontrolujte, zda je uživatel přihlášen a má správnou roli
// if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'superadmin')) {
//     header("Location: login.php"); // Přesměrování na přihlašovací stránku
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat novou pizzu</title>
    <link rel="icon" type="image/x-icon" href="pizza.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigační lišta -->
<?php include "navbar.php"; ?>

<!-- Hlavní obsah -->
<div class="container mt-4">
    <h1 class="text-center mb-4">Přidat novou pizzu</h1>
    <form action="process_add_pizza.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="pizzaName">Název pizzy</label>
            <input type="text" class="form-control" id="pizzaName" name="pizzaName" required>
        </div>
        <div class="form-group">
            <label for="pizzaDescription">Popis pizzy</label>
            <textarea class="form-control" id="pizzaDescription" name="pizzaDescription" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="pizzaPrice">Cena (Kč)</label>
            <input type="number" class="form-control" id="pizzaPrice" name="pizzaPrice" required>
        </div>
        <div class="form-group">
            <label for="pizzaImage">Obrázek pizzy</label>
            <input type="file" class="form-control-file" id="pizzaImage" name="pizzaImage" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Přidat pizzu</button>
    </form>
</div>

<!-- Footer -->
<footer>
    <p>Adresa: Pizzerie u Hvězdy, Hlavní 123, Praha 1</p>
    <p>Telefon: +420 123 456 789</p>
</footer>

<!-- Lokální Bootstrap JS a jQuery -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
