<?php
require 'db.php';
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
    <meta charset="UTF-8" />
    <title>Mijn Boekingen - Reisbureau</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f8;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            background-color: #0077cc;
            padding: 20px 40px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            margin: 0;
            font-weight: 600;
            font-size: 1.8rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        nav a:hover {
            color: #ffd700;
        }
        main {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        h2 {
            margin-top: 0;
            color: #0077cc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #e8f0fe;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f1f7ff;
        }
        .empty-message {
            text-align: center;
            padding: 30px;
            font-size: 1.1rem;
            color: #666;
        }
        .btn-primary {
            background-color: #0077cc;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-top: 20px;
        }
        .btn-primary:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
<header>
    <h1>Reisbureau - Welkom, <?= htmlspecialchars($_SESSION['naam']) ?></h1>
    <nav>
        <a href="book.php">Boek een Reis</a>
        <a href="logout.php">Uitloggen</a>
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
