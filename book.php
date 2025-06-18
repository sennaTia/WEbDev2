<?php
require 'db.php';
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
    <meta charset="UTF-8" />
    <title>Boek een Reis</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f8;
            margin: 0; padding: 0;
            color: #333;
        }
        header {
            background-color: #0077cc;
            color: white;
            padding: 20px 40px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
        }
        main {
            max-width: 600px;
            background: white;
            margin: 40px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        form label {
            display: block;
            margin-top: 20px;
            font-weight: 600;
        }
        select, button {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            background-color: #0077cc;
            color: white;
            border: none;
            margin-top: 30px;
            cursor: pointer;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
<header>
    Reis boeken — welkom, <?= htmlspecialchars($_SESSION['naam']) ?>
</header>
<main>
    <form action="verwerk_boeking.php" method="POST" id="boekForm">
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
