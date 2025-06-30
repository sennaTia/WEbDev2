<?php
session_start();

if (!isset($_SESSION['gebruiker_id']) || ($_SESSION['is_admin'] ?? 0) != 1) {
    header('Location: ../login.php?error=Geen+toegang');
    exit;
}

require '../php/db.php';

// Haal alle reizen op
$stmt = $pdo->query("SELECT * FROM reizen");
$reizen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Reizen Beheren</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Reizen Beheren</h1>
    <a href="dashboard.php">Terug naar dashboard</a>
    <a href="reis_toevoegen.php">Nieuwe reis toevoegen</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Bestemming</th>
            <th>Prijs</th>
            <th>Acties</th>
        </tr>
        <?php foreach ($reizen as $reis): ?>
            <tr>
                <td><?= htmlspecialchars($reis['id']) ?></td>
                <td><?= htmlspecialchars($reis['bestemming']) ?></td>
                <td><?= htmlspecialchars($reis['prijs']) ?></td>
                <td>
                    <a href="reis_bewerken.php?id=<?= $reis['id'] ?>">Bewerken</a> |
                    <a href="reis_verwijderen.php?id=<?= $reis['id'] ?>" onclick="return confirm('Weet je zeker dat je deze reis wilt verwijderen?');">Verwijderen</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
