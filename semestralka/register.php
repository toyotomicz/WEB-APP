<?php
session_start();
// Check for any error messages
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <link rel="icon" type="image/x-icon" href="pizza.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<!-- Navigační lišta -->
<?php include "navbar.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="text-center mb-4">Registrace</h2>
                
                
                
                <form action="process_register.php" method="post">
                    <div class="form-group">
                        <label for="username">Uživatelské jméno <i class="fas fa-user"></i></label>
                        <input type="text" class="form-control form-control-sm" id="username" name="username" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">E-mail <i class="fas fa-envelope"></i></label>
                        <input type="email" class="form-control form-control-sm" id="email" name="email" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="password">Heslo <i class="fas fa-lock"></i></label>
                        <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="confirm_password">Potvrdit heslo <i class="fas fa-lock"></i></label>
                        <input type="password" class="form-control form-control-sm" id="confirm_password" name="confirm_password" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">Registrovat se</button>
                </form>
                <br>
                <div class="text-center mt-3">
                    <a href="login.php">Máte účet? Přihlaste se zde!</a>
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

<!-- Local Bootstrap JS and jQuery -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
