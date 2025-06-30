
<?php
require '../php/db.php';
session_start();
 
if (!isset($_SESSION['gebruiker_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit;
}
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $soort = $_POST['soort'] ?? '';
    $prijs = $_POST['prijs'] ?? '';
 
    if ($soort && $prijs) {
        $stmt = $pdo->prepare("INSERT INTO vervoer (soort, prijs) VALUES (?, ?)");
        $stmt->execute([$soort, $prijs]);
        header('Location: vervoer.php');
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
    <title>Vervoer toevoegen</title>
</head>
<body>
    <h1>Vervoer toevoegen</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Soort: <input type="text" name="soort" required></label><br>
        <label>Prijs (€): <input type="number" step="0.01" name="prijs" required></label><br>
        <button type="submit">Opslaan</button>
    </form>
</body>
</html>