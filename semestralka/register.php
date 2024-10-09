<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <link rel="icon" type="image/x-icon" href="images/pizza.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigační lišta -->
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">Pizzerie</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Menu</a>
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
            <li class="nav-item active">
                <a class="nav-link" href="register.php">Registrace</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Registrační formulář -->
<div class="container register-container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Registrace</h2>
            <form action="processregister.php" method="POST">
                <div class="form-group">
                    <label for="username">Uživatelské jméno</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Heslo</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Potvrdit heslo</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Registrovat</button>
            </form>
        </div>
    </div>
</div>

<!-- Lokální Bootstrap JS a jQuery -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
