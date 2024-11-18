<?php
// Počet pizz v košíku
$cart_count = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;

// Předpokládáme, že informace o uživateli jsou uloženy v $_SESSION
$username = isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : null;
$role = isset($_SESSION['user']['role']) ? $_SESSION['user']['role'] : null;
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #34495e;">
    <a class="navbar-brand" href="http://localhost/web-app/semestralka/public/index.php/menu">Moje Pizzerie</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="menu">Menu</a>
            </li>
            <?php if (!$username): ?>
                <li class="nav-item">
                    <a class="nav-link" href="login">Přihlášení</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register">Registrace</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="orders">Objednávky</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add-pizza">Pizzy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add-cook">Přidat kuchaře</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add-admin">Přidat admina</a>
                </li>
                <li class="nav-item">
                    <span class="navbar-text text-light">
                        Přihlášen jako: <?php echo htmlspecialchars($username); ?> (Role: <?php echo htmlspecialchars($role); ?>)
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout">Odhlásit se</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="cart">
                    Košík <span class="badge badge-pill badge-danger"><?php echo $cart_count; ?></span>
                </a>
            </li>
        </ul>
    </div>
</nav>