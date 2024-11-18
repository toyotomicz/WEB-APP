<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <link href="<?= BASEURL ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASEURL ?>css/style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Přihlášení</h2>
                        
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?= htmlspecialchars($_SESSION['error']) ?>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['success_message'])): ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <?= htmlspecialchars($_SESSION['success_message']) ?>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <?php unset($_SESSION['success_message']); ?>
                        <?php endif; ?>
                        
                        <form action="<?= BASEURL ?>index.php/login" method="post" class="needs-validation" novalidate>
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                            
                            <div class="form-group">
                                <label for="username">Uživatelské jméno</label>
                                <input  type="text" 
                                        id="username"
                                        name="username" 
                                        class="form-control" 
                                        required 
                                        value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
                                <div class="invalid-feedback">
                                    Zadejte uživatelské jméno
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Heslo</label>
                                <input type="password" 
                                       id="password"
                                       name="password" 
                                       class="form-control" 
                                       required>
                                <div class="invalid-feedback">
                                    Zadejte heslo
                                </div>
                            </div>                                          
                            <button type="submit" class="btn btn-primary btn-block">Přihlásit se</button>
                        </form>
                        
                        <p class="text-center mt-3">
                            Nemáte účet? <a href="<?= BASEURL ?>register">Zaregistrujte se</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= BASEURL ?>js/jquery.min.js"></script>
    <script src="<?= BASEURL ?>js/bootstrap.bundle.min.js"></script>
    <script>
    // Validace formuláře na straně klienta
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
                }, false);
            });
        }, false);
    })();
    </script>
</body>
</html>