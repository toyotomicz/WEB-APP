<?php
// Počet pizz v košíku
$cart_count = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;

// Předpokládáme, že informace o uživateli jsou uloženy v $_SESSION
$username = isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : null;
$role = isset($_SESSION['user']['role']) ? (int)$_SESSION['user']['role'] : null;
?>

<nav class="navbar navbar-expand-xxl navbar-dark" style="background-color: #34495e;">
    <a class="navbar-brand" href="http://localhost/web-app/semestralka/public/index.php/menu">Moje Pizzerie</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <?php if (!$username): ?>
                <!-- Pokud není uživatel přihlášen -->
                <li class="nav-item">
                        <a class="nav-link" href="menu">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login">Přihlášení</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register">Registrace</a>
                </li>
            <?php else: ?>
                <!-- Navigace podle role -->
                <?php if ($role === 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="orders">Objednávky</a>
                    </li>
                <?php elseif ($role === 2 || $role === 3 || $role === 4): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="cart">
                            Košík <span class="badge bg-danger rounded-pill"><?php echo $cart_count; ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($role === 3 || $role === 4): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="orders">Objednávky</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add-pizza">Pizzy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add-cook">Přidat kuchaře</a>
                    </li>
                <?php endif; ?>

                <?php if ($role === 4): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="add-admin">Přidat admina</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <span class="navbar-text text-light">
                        Přihlášen jako: <?php echo htmlspecialchars($username); ?> (Role: <?php echo htmlspecialchars($role); ?>)
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout">Odhlásit se</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
