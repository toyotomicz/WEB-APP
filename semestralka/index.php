<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzerie</title>
    <link rel="icon" type="image/x-icon" href="pizza.ico">
    <!-- Lokální Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigační lišta -->
<?php include "navbar.php"; ?>

<!-- Hlavní obsah -->
<div class="container mt-4">
    <h1 class="text-center mb-4">Naše nabídka pizz</h1>
    <div class="row">
        <!-- Pizza 1 -->
        <div class="col-md-4">
            <div class="card pizza-card">
                <img src="images/pizza1.webp" class="card-img-top pizza-image" alt="Pizza Margherita">
                <div class="card-body">
                    <h5 class="card-title">Pizza Margherita</h5>
                    <p class="card-text">Tradiční pizza s rajčatovou omáčkou a mozzarellou.</p>
                    <p class="card-text"><strong>Cena: 180 Kč</strong></p>
                    <button class="btn btn-primary btn-block">Objednat</button>
                </div>
            </div>
        </div>
        <!-- Pizza 2 -->
        <div class="col-md-4">
            <div class="card pizza-card">
                <img src="images/pizza2.webp" class="card-img-top pizza-image" alt="Pizza Salami">
                <div class="card-body">
                    <h5 class="card-title">Pizza Salami</h5>
                    <p class="card-text">Pizza s pikantním salámem a rajčatovou omáčkou.</p>
                    <p class="card-text"><strong>Cena: 200 Kč</strong></p>
                    <button class="btn btn-primary btn-block">Objednat</button>
                </div>
            </div>
        </div>
        <!-- Pizza 3 -->
        <div class="col-md-4">
            <div class="card pizza-card">
                <img src="images/pizza3.webp" class="card-img-top pizza-image" alt="Pizza Quattro Formaggi">
                <div class="card-body">
                    <h5 class="card-title">Pizza Quattro Formaggi</h5>
                    <p class="card-text">Pizza se čtyřmi druhy sýrů: mozzarella, gorgonzola, parmezán a pecorino.</p>
                    <p class="card-text"><strong>Cena: 220 Kč</strong></p>
                    <button class="btn btn-primary btn-block">Objednat</button>
                </div>
            </div>
        </div>
    </div>
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
