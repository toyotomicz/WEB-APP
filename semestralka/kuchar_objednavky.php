<?php
// Připojení k databázi
include "Data/mydatabase.class.php"; // Zahrňte soubor s třídou pro správu databáze
include "Data/settings.inc.php"; // Zahrňte soubor s nastavením databáze

// Načtení objednávek z databáze
$query = "SELECT o.id AS id, o.customer_id, oi.quantity, p.name AS pizza_name, p.price AS pizza_price, o.status
            FROM orders o
            JOIN order_items oi ON o.id = oi.id
            JOIN pizza_types p ON oi.id = p.id";
// Zpracování filtru
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];

    if ($filter == 'v_priprave') {
        $query .= " WHERE o.status = 'Vytvořeno'";
    } elseif ($filter == 'dokonceno') {
        $query .= " WHERE o.status = 'Dokončeno'";
    }
}
$db = new MyDatabase(DB_SERVER, DB_NAME, DB_USER, DB_PASS);
// Načtení objednávek z databáze
$result = $db->query($query);
?>

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

<?php include "navbar.php"; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Seznam objednávek</h2>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['message']; ?>
            <?php unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <div class="filter-section mb-4">
        <a href="kuchar_objednavky.php?filter=all" class="btn btn-primary">Všechny objednávky</a>
        <a href="kuchar_objednavky.php?filter=v_priprave" class="btn btn-warning">V přípravě</a>
        <a href="kuchar_objednavky.php?filter=dokonceno" class="btn btn-success">Dokončené</a>
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
            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo isset($row['zakaznik']) ? htmlspecialchars($row['zakaznik']) : 'Neznámý zákazník'; ?></td>
                    <td>
                        <?php echo htmlspecialchars($row['pizza_name']) . ' (x' . $row['quantity'] . ')'; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
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

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>