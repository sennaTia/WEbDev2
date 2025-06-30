<?php
require '../php/db.php';
session_start();

// Alleen admin
if (!isset($_SESSION['gebruiker_id']) || ($_SESSION['is_admin'] ?? 0) != 1) {
    header('Location: ../login.php?error=Geen+toegang');
    exit;
}

// Verwijder-verzoek
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $stmt = $pdo->prepare("DELETE FROM vervoer WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: vervoer.php');
    exit;
}

// Haal alle vervoer op
$vervoers = $pdo->query("SELECT * FROM vervoer")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Beheer Vervoer</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Vervoer Beheren</h1>
    <a href="dashboard.php">← Terug naar Dashboard</a>
    <a href="add_vervoer.php">➕ Nieuw Vervoer Toevoegen</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Soort</th>
                <th>Prijs</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vervoers as $v): ?>
                <tr>
                    <td><?= $v['id'] ?></td>
                    <td><?= htmlspecialchars($v['soort']) ?></td>
                    <td>€<?= number_format($v['prijs'], 2) ?></td>
                    <td>
                        <a href="?delete_id=<?= $v['id'] ?>" onclick="return confirm('Weet je zeker dat je dit vervoer wilt verwijderen?')">❌ Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
