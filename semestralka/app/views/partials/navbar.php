<?php
// Počet pizz v košíku
$cart_count = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #34495e;">
    <a class="navbar-brand" href="#">Pizzerie</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="menu">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login">Přihlášení</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register">Registrace</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders">Objednavky</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add-pizza">Pizzy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add-cook">Pridat kuchare</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add-admin">Pridat admina</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart">
                    Košík <span class="badge badge-pill badge-danger"><?php echo $cart_count; ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout">Odhlásit se</a>
            </li>
        </ul>
    </div>
</nav>