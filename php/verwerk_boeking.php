<?php
require 'db.php';
session_start();

if (!isset($_SESSION['gebruiker_id'])) {
    header('Location: /login.php');
    exit;
}

$gebruiker_id = $_SESSION['gebruiker_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $land = $_POST['land'] ?? '';
    $hotel_id = $_POST['hotel'] ?? '';
    $vervoer_id = $_POST['vervoer'] ?? '';

    // Basis validatie
    if (!$land || !$hotel_id || !$vervoer_id) {
        die("❌ Vul alle velden correct in.");
    }

    // Check of hotel bestaat en land klopt
    $stmt = $pdo->prepare("SELECT prijs_per_nacht, land FROM hotels WHERE id = ?");
    $stmt->execute([$hotel_id]);
    $hotel = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$hotel || $hotel['land'] !== $land) {
        die("❌ Ongeldig hotel of land gekozen.");
    }

    // Check of vervoer bestaat
    $stmt = $pdo->prepare("SELECT prijs FROM vervoer WHERE id = ?");
    $stmt->execute([$vervoer_id]);
    $vervoer = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$vervoer) {
        die("❌ Ongeldig vervoer gekozen.");
    }

    // Bereken totaalprijs (bijvoorbeeld 3 nachten standaard)
    $aantal_nachten = 3;
    $totaal_prijs = $hotel['prijs_per_nacht'] * $aantal_nachten + $vervoer['prijs'];

    // Insert in boekingen
    $stmt = $pdo->prepare("INSERT INTO boekingen (gebruiker_id, hotel_id, vervoer_id, prijs, boekingsdatum) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$gebruiker_id, $hotel_id, $vervoer_id, $totaal_prijs]);

    // Bevestigingsbericht + link terug naar account
    echo "<!DOCTYPE html><html lang='nl'><head><meta charset='UTF-8'><title>Boeking Bevestigd</title></head><body style='font-family:sans-serif; max-width:600px; margin:50px auto;'>";
    echo "<h1>🎉 Boeking succesvol!</h1>";
    echo "<p>Je reis naar <strong>" . htmlspecialchars($land) . "</strong> met verblijf in <strong>" . htmlspecialchars($hotel['land']) . "</strong> is geboekt.</p>";
    echo "<p>Totaalprijs: €" . number_format($totaal_prijs, 2) . "</p>";
    echo "<p><a href='/account.php'>Terug naar je account</a></p>";
    echo "</body></html>";
    exit;
} else {
    header('Location: /book.php');
    exit;
}