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
    $stmt = $pdo->prepare("DELETE FROM hotels WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: hotel.php');
    exit;
}

// Haal alle hotels op
$hotels = $pdo->query("SELECT * FROM hotels")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Beheer Hotels</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Hotels Beheren</h1>
    <a href="dashboard.php">← Terug naar Dashboard</a>
    <a href="add_hotel.php">➕ Nieuw Hotel Toevoegen</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Land</th>
                <th>Prijs per Nacht</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hotels as $h): ?>
                <tr>
                    <td><?= $h['id'] ?></td>
                    <td><?= htmlspecialchars($h['naam']) ?></td>
                    <td><?= htmlspecialchars($h['land']) ?></td>
                    <td>€<?= number_format($h['prijs_per_nacht'], 2) ?></td>
                    <td>
                        <a href="?delete_id=<?= $h['id'] ?>" onclick="return confirm('Weet je zeker dat je dit hotel wilt verwijderen?')">❌ Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
