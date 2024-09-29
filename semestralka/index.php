<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzerie</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .pizza-card {
            margin-bottom: 20px;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .pizza-image {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<!-- Navigační lišta -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Pizzerie</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">O nás</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Kontakt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Přihlášení</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Hlavní obsah -->
<div class="container mt-4">
    <h1 class="text-center mb-4">Naše nabídka pizz</h1>
    <div class="row">
        <!-- Pizza 1 -->
        <div class="col-md-4">
            <div class="card pizza-card">
                <img src="https://via.placeholder.com/300x200" class="card-img-top pizza-image" alt="Pizza Margherita">
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
                <img src="https://via.placeholder.com/300x200" class="card-img-top pizza-image" alt="Pizza Salami">
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
                <img src="https://via.placeholder.com/300x200" class="card-img-top pizza-image" alt="Pizza Quattro Formaggi">
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

<!-- Bootstrap JS a jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
