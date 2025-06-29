<?php
require 'php/db.php';
session_start();

if (!isset($_SESSION['gebruiker_id'])) {
    header('Location: login.php');
    exit;
}

// Haal vervoer, hotels en landen op uit DB
$vervoer = $pdo->query("SELECT id, soort, prijs FROM vervoer")->fetchAll(PDO::FETCH_ASSOC);
$hotels = $pdo->query("SELECT id, naam, land, prijs_per_nacht FROM hotels")->fetchAll(PDO::FETCH_ASSOC);
$landen = $pdo->query("SELECT DISTINCT land FROM hotels")->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
      <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8" />
    <title>Boek een Reis</title>
   
</head>
<body>
<header>
    Reis boeken — welkom, <?= htmlspecialchars($_SESSION['naam']) ?>
</header>
<main>
    <form action="php/verwerk_boeking.php" method="POST" id="boekForm">
        <label for="land">Land:</label>
        <select name="land" id="land" required>
            <option value="" disabled selected>-- Kies een land --</option>
            <?php foreach ($landen as $land): ?>
                <option value="<?= htmlspecialchars($land) ?>"><?= htmlspecialchars($land) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="hotel">Hotel:</label>
        <select name="hotel" id="hotel" required>
            <option value="" disabled selected>-- Kies een hotel --</option>
            <?php foreach ($hotels as $hotel): ?>
                <option value="<?= htmlspecialchars($hotel['id']) ?>" data-land="<?= htmlspecialchars($hotel['land']) ?>">
                    <?= htmlspecialchars($hotel['naam']) ?> - <?= htmlspecialchars($hotel['land']) ?> - €<?= number_format($hotel['prijs_per_nacht'], 2) ?> p.n.
                </option>
            <?php endforeach; ?>
        </select>

        <label for="vervoer">Vervoer:</label>
        <select name="vervoer" id="vervoer" required>
            <option value="" disabled selected>-- Kies vervoer --</option>
            <?php foreach ($vervoer as $v): ?>
                <option value="<?= htmlspecialchars($v['id']) ?>">
                    <?= htmlspecialchars($v['soort']) ?> - €<?= number_format($v['prijs'], 2) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Boek Nu</button>
    </form>
</main>

<script>
// Filter hotels afhankelijk van gekozen land
const landSelect = document.getElementById('land');
const hotelSelect = document.getElementById('hotel');

landSelect.addEventListener('change', function() {
    const selectedLand = this.value;
    for (const option of hotelSelect.options) {
        if (option.value === "") continue; // placeholder
        option.style.display = option.dataset.land === selectedLand ? 'block' : 'none';
    }
    hotelSelect.value = ""; // reset hotel keuze
});
</script>


</body>
</html>