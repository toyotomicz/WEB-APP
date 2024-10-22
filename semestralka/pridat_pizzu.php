<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat Pizzu</title>
    <link rel="icon" type="image/x-icon" href="pizza.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigační lišta -->
<?php include "navbar.php"; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Přidat Pizzu</h2>

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

    <form action="pridat_pizzu.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nazev">Název pizzy</label>
            <input type="text" class="form-control" id="nazev" name="nazev" required>
        </div>
        <br>
        <div class="form-group">
            <label for="cena">Cena</label>
            <input type="number" class="form-control" id="cena" name="cena" required>
        </div>
        <br>
        <div class="form-group">
            <label for="popis">Popis</label>
            <textarea class="form-control" id="popis" name="popis" rows="3" required></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="fotka">Fotka pizzy</label>
            <input type="file" class="form-control-file" id="fotka" name="fotka" accept="image/*" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary btn-block">Přidat Pizzu</button>
    </form>
</div>

<!-- Local Bootstrap JS and jQuery -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
