<?php
// Získání odeslaných hodnot z formuláře
$username = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

// Zahashování hesla
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
$hashed_confirm_password = password_hash($confirm_password, PASSWORD_BCRYPT);

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Registration</title>
    <!-- Odkaz na stažený Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Zadané hodnoty registrace</h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Pole</th>
                <th>Hodnota</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Uživatelské jméno</td>
                <td><?php echo htmlspecialchars($username); ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo htmlspecialchars($email); ?></td>
            </tr>
            <tr>
                <td>Hash hesla</td>
                <td><?php echo htmlspecialchars($hashed_password); ?></td>
            </tr>
            <tr>
                <td>Hash hesla potvrzeni</td>
                <td><?php ; ?></td>
            </tr>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="register.php" class="btn btn-primary">Zpět na registrační stránku</a>
    </div>
</div>

<!-- Odkaz na stažený Bootstrap JS -->
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
