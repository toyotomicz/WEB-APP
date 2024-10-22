<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <link rel="icon" type="image/x-icon" href="pizza.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigační lišta -->
<?php include "navbar.php"; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Seznam objednávek</h2>

    <!-- Zobrazení zprávy po označení objednávky jako dokončené -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['message']; ?>
            <?php unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <!-- Filtrace objednávek dle stavu -->
    <div class="filter-section mb-4">
        <a href="kuchar_objednavky.php?filter=all" class="btn btn-primary">Všechny objednávky</a>
        <a href="kuchar_objednavky.php?filter=v_priprave" class="btn btn-warning">V přípravě</a>
        <a href="kuchar_objednavky.php?filter=dokonceno" class="btn btn-success">Dokončené</a>
    </div>

    <!-- Tabulka objednávek -->
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
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['zakaznik']; ?></td>
                    <td><?php echo $row['polozky']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <?php if ($row['status'] == 'V přípravě'): ?>
                            <form action="kuchar_objednavky.php" method="post">
                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="complete_order" class="btn btn-success">Označit jako dokončené</button>
                            </form>
                        <?php else: ?>
                            <span class="text-success">Dokončeno</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Local Bootstrap JS and jQuery -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
