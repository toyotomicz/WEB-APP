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

<div class="wrapper">
    <div class="content">
        <div class="container mt-5">
            <h2 class="text-center mb-4">Vyberte si pizzu</h2>

            <div class="row">
            <?php foreach ($pizzas as $pizza): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-stretch">
                    <div class="pizza-card mb-4 w-100">
                        <img src="http://localhost/web-app/semestralka/uploads/<?php echo htmlspecialchars($pizza['image_path']); ?>" alt="<?php echo htmlspecialchars($pizza['name']); ?>" class="pizza-img img-fluid">
                        <h3 class="mt-2"><?php echo htmlspecialchars($pizza['name']); ?></h3>
                        <p><strong><?php echo number_format($pizza['price'], 2); ?> Kč</strong></p>
                        <form method="post" action="">
                            <input type="hidden" name="pizza_id" value="<?php echo htmlspecialchars($pizza['id']); ?>">
                            <input type="hidden" name="pizza_name" value="<?php echo htmlspecialchars($pizza['name']); ?>">
                            <input type="hidden" name="pizza_price" value="<?php echo $pizza['price']; ?>">
                            <input type="hidden" name="pizza_image" value="<?php echo htmlspecialchars($pizza['image_path']); ?>">
                            <?php if (isset($_SESSION['user'])): ?>
                                <button type="submit" class="btn btn-primary btn-block">Objednat</button>
                            <?php else: ?>
                                <button type="button" class="btn btn-secondary btn-block" disabled style="cursor: not-allowed;">Přihlaste se pro objednávku</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>

<script src="<?=BASEURL?>js/jquery.min.js"></script>
<script src="<?=BASEURL?>js/bootstrap.bundle.min.js"></script>

</body>
</html>
