<?php
require '../php/db.php';
session_start();
 
// Alleen admin
if (!isset($_SESSION['gebruiker_id']) || ($_SESSION['is_admin'] ?? 0) != 1) {
    header('Location: ../login.php');
    exit;
}
 
// Haal alle hotels op
$hotels = $pdo->query("SELECT * FROM hotels")->fetchAll(PDO::FETCH_ASSOC);
?>
 
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Hotels Beheer</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Hotels</h1>
    <a href="add_hotel.php">+ Nieuw hotel toevoegen</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Land</th>
            <th>Prijs per nacht</th>
        </tr>
        <?php foreach ($hotels as $hotel): ?>
        <tr>
            <td><?= $hotel['id'] ?></td>
            <td><?= htmlspecialchars($hotel['naam']) ?></td>
            <td><?= htmlspecialchars($hotel['land']) ?></td>
            <td>€<?= number_format($hotel['prijs_per_nacht'], 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>