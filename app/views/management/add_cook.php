<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat kuchaře</title>
    <link rel="icon" type="image/x-icon" href="<?=BASEURL?>images/pizza.ico">
    <link href="<?=BASEURL?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=BASEURL?>css/style.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Přidat Kuchaře</h2>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success text-center">
            <?= $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php elseif (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger text-center">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASEURL ?>index.php/add-cook" method="post">
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

<script src="<?=BASEURL?>js/jquery.min.js"></script>
<script src="<?=BASEURL?>js/bootstrap.bundle.min.js"></script>

</body>
</html>
