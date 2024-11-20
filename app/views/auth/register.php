<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <link href="<?= BASEURL ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASEURL ?>css/style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Registrace</h2>
                        
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?= htmlspecialchars($_SESSION['error']) ?>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>

                        <form action="<?= BASEURL ?>index.php/register" method="post" class="needs-validation" novalidate>
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

                            <div class="form-group">
                                <label for="username">Uživatelské jméno</label>
                                <input type="text" id="username" name="username" class="form-control" required 
                                    value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
                                <div class="invalid-feedback">Uživatelské jméno je povinné.</div>
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" name="email" class="form-control" required 
                                    value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                                <div class="invalid-feedback">Zadejte platnou e-mailovou adresu</div>
                            </div>

                            <div class="form-group">
                                <label for="password">Heslo</label>
                                <input type="password" id="password" name="password" class="form-control" required minlength="3">
                                <div class="invalid-feedback">Heslo musí mít alespoň 3 znaky</div>
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">Potvrzení hesla</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                                <div class="invalid-feedback">Hesla se musí shodovat</div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">Registrovat se</button>
                        </form>

                        <p class="text-center mt-3">Již máte účet? <a href="<?= BASEURL ?>index.php/login">Přihlaste se</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= BASEURL ?>js/jquery.min.js"></script>
    <script src="<?= BASEURL ?>js/bootstrap.bundle.min.js"></script>
    <script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');

                    // Kontrola shody hesel
                    var password = document.getElementById('password');
                    var confirm = document.getElementById('confirm_password');
                    confirm.setCustomValidity(password.value !== confirm.value ? 'Hesla se neshodují' : '');
                }, false);
            });
        }, false);
    })();
    </script>
</body>
</html>
