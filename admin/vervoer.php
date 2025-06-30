<?php
require '../php/db.php';
session_start();
 
// Alleen admin
if (!isset($_SESSION['gebruiker_id']) || ($_SESSION['is_admin'] ?? 0) != 1) {
    header('Location: ../login.php');
    exit;
}
 
// Haal alle vervoer op
$vervoer = $pdo->query("SELECT * FROM vervoer")->fetchAll(PDO::FETCH_ASSOC);
?>
 
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vervoer Beheer</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Vervoer</h1>
    <a href="add_vervoer.php">+ Nieuw vervoer toevoegen</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Soort</th>
            <th>Prijs</th>
        </tr>
        <?php foreach ($vervoer as $v): ?>
        <tr>
            <td><?= $v['id'] ?></td>
            <td><?= htmlspecialchars($v['soort']) ?></td>
            <td>€<?= number_format($v['prijs'], 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
 