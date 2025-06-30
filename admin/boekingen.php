<?php
require '../php/db.php';
session_start();

// Alleen admin toegang
if (!isset($_SESSION['gebruiker_id']) || ($_SESSION['is_admin'] ?? 0) != 1) {
    header('Location: ../login.php');
    exit;
}

// Boekingen ophalen
$sql = "SELECT b.id, g.naam AS gebruiker_naam, g.email, h.naam AS hotel_naam, h.land, v.soort AS vervoer_soort, b.prijs, b.boekingsdatum
        FROM boekingen b
        JOIN gebruikers g ON b.gebruiker_id = g.id
        JOIN hotels h ON b.hotel_id = h.id
        JOIN vervoer v ON b.vervoer_id = v.id
        ORDER BY b.boekingsdatum DESC";
$boekingen = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Boekingen Overzicht</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Boekingen</h1>
    <a href="dashboard.php">← Terug naar Dashboard</a>

    <?php if (empty($boekingen)): ?>
        <p>Er zijn nog geen boekingen.</p>
    <?php else: ?>
        <div class="scroll-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gebruiker</th>
                        <th>Email</th>
                        <th>Hotel</th>
                        <th>Vervoer</th>
                        <th>Prijs (€)</th>
                        <th>Datum</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($boekingen as $b): ?>
                        <tr>
                            <td><?= $b['id'] ?></td>
                            <td><?= htmlspecialchars($b['gebruiker_naam']) ?></td>
                            <td><?= htmlspecialchars($b['email']) ?></td>
                            <td><?= htmlspecialchars($b['hotel_naam']) ?> (<?= htmlspecialchars($b['land']) ?>)</td>
                            <td><?= htmlspecialchars($b['vervoer_soort']) ?></td>
                            <td>€<?= number_format($b['prijs'], 2) ?></td>
                            <td><?= $b['boekingsdatum'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <!-- Laad je scroll script -->
    <script src="../js/tableScroll.js"></script>
</body>
</html>
