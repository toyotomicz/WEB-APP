<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výběr Pizzy</title>
    <link rel="icon" type="image/x-icon" href="<?=BASEURL?>images/pizza.ico">
    <link href="<?=BASEURL?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=BASEURL?>css/style.css">
</head>

<body>
    <div class="container">
        <h2>Přidat Novou Pizzu</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="/web-app/semestralka/public/index.php/add-new-pizza" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Název:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Cena:</label>
                <input type="number" id="price" name="price" class="form-control" required min="0" step="0.01">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Obrázek (JPEG, PNG, max 2MB):</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/jpeg, image/png, image/webp" required>
            </div>

            <button type="submit" class="btn btn-primary">Přidat Pizzu</button>
        </form>
    </div>

    <script src="<?=BASEURL?>js/jquery.min.js"></script>
    <script src="<?=BASEURL?>js/bootstrap.bundle.min.js"></script>
</body>
</html>