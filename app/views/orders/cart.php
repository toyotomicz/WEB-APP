<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Košík</title>
    <link href="http://localhost/web-app/semestralka/public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="http://localhost/web-app/semestralka/public/images/pizza.ico">
    <link rel="stylesheet" href="http://localhost/web-app/semestralka/public/css/style.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Váš košík</h2>

    <?php if (!empty($cartItems)): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Obrázek</th>
                    <th>Název</th>
                    <th>Cena</th>
                    <th>Množství</th>
                    <th>Celkem</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $id => $item): ?>
                    <tr>
                        <td><img src="http://localhost/web-app/semestralka/uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="img-thumbnail" style="width: 50px;"></td>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo number_format($item['price'], 2); ?> Kč</td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo number_format($item['price'] * $item['quantity'], 2); ?> Kč</td>
                        <td>
                            <form method="post" action="<?= BASEURL ?>index.php/cart-remove" class="d-inline">
                                <input type="hidden" name="pizza_id" value="<?php echo $id; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Odstranit</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Zobrazení celkové ceny -->
        <div class="d-flex justify-content-end">
            <h4 class="me-3">Celková cena: <strong><?php echo number_format($this->calculateTotalPrice($cartItems), 2); ?> Kč</strong></h4>
        </div>

        <!-- Akční tlačítka pod tabulkou -->
        <div class="d-flex justify-content-between mt-4">
            <form method="post" action="<?= BASEURL ?>index.php/cart-clear">
                <button type="submit" class="btn btn-warning">Vyprázdnit košík</button>
            </form>
            <form method="POST" action="<?= BASEURL ?>index.php/cart-submit">
                <button type="submit" class="btn btn-success">Odeslat objednávku</button>
            </form>
        </div>

    <?php else: ?>
        <p class="text-center text-muted mt-5">Váš košík je prázdný.</p>
    <?php endif; ?>
</div>

<script src="http://localhost/web-app/semestralka/public/js/jquery.min.js"></script>
<script src="http://localhost/web-app/semestralka/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>