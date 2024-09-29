<?php
// Získání odeslaných hodnot z formuláře
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                <td>Uživatelské jméno</td>
                <td><?php echo htmlspecialchars($username); ?></td>
            </tr>
            <tr>
                <td>Heslo</td>
                <td><?php echo htmlspecialchars($password); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="login.php" class="btn btn-primary">Zpět na přihlašovací stránku</a>
    </div>
</div>

<!-- Bootstrap JS a jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
