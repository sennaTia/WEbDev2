<?php
session_start();
require '../php/db.php';

// Check of de gebruiker is ingelogd én admin is
if (!isset($_SESSION['gebruiker_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit;
}

// Haal alle boekingen op
$stmt = $pdo->query("SELECT * FROM boekingen");
$boekingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Boekingen Overzicht</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Alle Boekingen</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Gebruiker ID</th>
            <th>Hotel ID</th>
            <th>Vervoer ID</th>
            <th>Prijs</th>
            <th>Boekingsdatum</th>
        </tr>
        <?php foreach ($boekingen as $boeking): ?>
            <tr>
                <td><?= htmlspecialchars($boeking['id']) ?></td>
                <td><?= htmlspecialchars($boeking['gebruiker_id']) ?></td>
                <td><?= htmlspecialchars($boeking['hotel_id']) ?></td>
                <td><?= htmlspecialchars($boeking['vervoer_id']) ?></td>
                <td>&euro; <?= htmlspecialchars($boeking['prijs']) ?></td>
                <td><?= htmlspecialchars($boeking['boekingsdatum']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p><a href="dashboard.php">⬅ Terug naar dashboard</a></p>
</body>
</html>
