<?php
require '../php/db.php';
session_start();
 
// Alleen admin
if (!isset($_SESSION['gebruiker_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit;
}
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'] ?? '';
    $land = $_POST['land'] ?? '';
    $prijs = $_POST['prijs'] ?? '';
 
    if ($naam && $land && $prijs) {
        $stmt = $pdo->prepare("INSERT INTO hotels (naam, land, prijs_per_nacht) VALUES (?, ?, ?)");
        $stmt->execute([$naam, $land, $prijs]);
        header('Location: hotel.php');
        exit;
    } else {
        $error = "Vul alle velden in.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Hotel toevoegen</title>
</head>
<body>
    <h1>Hotel toevoegen</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Naam: <input type="text" name="naam" required></label><br>
        <label>Land: <input type="text" name="land" required></label><br>
        <label>Prijs per nacht (€): <input type="number" step="0.01" name="prijs" required></label><br>
        <button type="submit">Opslaan</button>
    </form>
</body>
</html>