<?php
// Získání odeslaných hodnot z formuláře
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Zahashování hesla
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Login</title>
    <!-- Odkaz na stažený Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Zadané hodnoty přihlášení</h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Pole</th>
                <th>Hodnota</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Email</td>
                <td><?php echo htmlspecialchars($email); ?></td>
            </tr>
            <tr>
                <td>Hash hesla</td>
                <td><?php echo htmlspecialchars($hashedPassword); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="login.php" class="btn btn-primary">Zpět na přihlašovací stránku</a>
    </div>
</div>

<!-- Odkaz na stažený Bootstrap JS -->
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
