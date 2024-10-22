<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat Kuchaře</title>
    <link rel="icon" type="image/x-icon" href="images/pizza.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigační lišta -->
<?php include "navbar.php"; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Přidat Kuchaře</h2>

    <!-- Zobrazení zpráv -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['message']; ?>
            <?php unset($_SESSION['message']); ?>
        </div>
    <?php elseif (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger text-center">
            <?php echo $_SESSION['error']; ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="pridat_kuchare.php" method="post">
        <div class="form-group">
            <label for="username">Uživatelské jméno</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <br>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <br>
        <div class="form-group">
            <label for="password">Heslo</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary btn-block">Přidat Kuchaře</button>
    </form>
</div>

<!-- Local Bootstrap JS and jQuery -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
