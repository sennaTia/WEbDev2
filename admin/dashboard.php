<?php
session_start();

// Controleer of de gebruiker is ingelogd en admin is
if (!isset($_SESSION['gebruiker_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welkom in het Admin Dashboard</h1>
    <p>Hallo, <?= htmlspecialchars($_SESSION['naam']) ?>!</p>

    <ul>
        <li><a href="reizen.php">Reizen beheren</a></li>
        <li><a href="boekingen.php">Boekingen bekijken</a></li>
        <li><a href="logout.php">Uitloggen</a></li>
    </ul>
</body>
</html>
