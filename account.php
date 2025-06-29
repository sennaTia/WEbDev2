<?php
require 'php/db.php';
session_start();

if (!isset($_SESSION['gebruiker_id'])) {
    header('Location: login.php');
    exit;
}

$gebruiker_id = $_SESSION['gebruiker_id'];

// Haal alle boekingen van de gebruiker op met hotel en vervoer info
$stmt = $pdo->prepare("
    SELECT b.id, h.naam AS hotel_naam, h.land, v.soort AS vervoer_soort, b.prijs, b.boekingsdatum
    FROM boekingen b
    JOIN hotels h ON b.hotel_id = h.id
    JOIN vervoer v ON b.vervoer_id = v.id
    WHERE b.gebruiker_id = ?
    ORDER BY b.boekingsdatum DESC
");
$stmt->execute([$gebruiker_id]);
$boekingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
      <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8" />
    <title>Mijn Boekingen - Reisbureau</title>
   
</head>
<body>
<header>
    <h1>Reisbureau - Welkom, <?= htmlspecialchars($_SESSION['naam']) ?></h1>
    <nav>
        <a href="book.php">Boek een Reis</a>
        <a href="php/logout.php">Uitloggen</a>
    </nav>
</header>
<main>
    <h2>Mijn Boekingen</h2>

    <?php if (count($boekingen) === 0): ?>
        <p class="empty-message">Je hebt nog geen reizen geboekt.</p>
        <a href="book.php" class="btn-primary">Boek nu je eerste reis</a>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Hotel</th>
                    <th>Land</th>
                    <th>Vervoer</th>
                    <th>Prijs (€)</th>
                    <th>Boekingsdatum</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($boekingen as $b): ?>
                <tr>
                    <td><?= htmlspecialchars($b['hotel_naam']) ?></td>
                    <td><?= htmlspecialchars($b['land']) ?></td>
                    <td><?= htmlspecialchars($b['vervoer_soort']) ?></td>
                    <td>€<?= number_format($b['prijs'], 2) ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($b['boekingsdatum'])) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href="book.php" class="btn-primary">Boek een nieuwe reis</a>
    <?php endif; ?>
</main>

</body>
</html>