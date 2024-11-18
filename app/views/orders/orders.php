<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Objednávky</title>
    <link href="http://localhost/web-app/semestralka/public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="http://localhost/web-app/semestralka/public/images/pizza.ico">
    <link href="http://localhost/web-app/semestralka/public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/web-app/semestralka/public/css/style.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Seznam objednávek</h2>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <div class="filter-section mb-4">
        <a href="?filter=all" class="btn btn-primary">Všechny objednávky</a>
        <a href="?filter=v_priprave" class="btn btn-warning">V přípravě</a>
        <a href="?filter=dokonceno" class="btn btn-success">Dokončené</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID objednávky</th>
                <th>Zákazník</th>
                <th>Položky</th>
                <th>Stav</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $row): ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['customer_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['items']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <?php if ($row['status'] == 'V přípravě'): ?>
                            <form action="mark-as-completed" method="post">
                                <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                <button type="submit" name="complete_order" class="btn btn-success">Označit jako dokončené</button>
                            </form>
                        <?php else: ?>
                            <span class="text-success">Dokončeno</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>


<script src="http://localhost/web-app/semestralka/public/js/jquery.min.js"></script>
<script src="http://localhost/web-app/semestralka/public/js/bootstrap.bundle.min.js"></script>

</body>
</html>
