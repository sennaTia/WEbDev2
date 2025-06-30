<?php
require '../php/db.php';
session_start();
 
// Alleen admin toegang
if (!isset($_SESSION['gebruiker_id']) || ($_SESSION['is_admin'] ?? 0) != 1) {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <p>Welkom, <?= htmlspecialchars($_SESSION['naam']) ?>!</p>
    </header>
    <main>
        <ul>
            <li><a href="reizen.php">Reizen beheren</a></li>
            <li><a href="hotel.php">Hotels beheren</a></li>
            <li><a href="vervoer.php">Vervoer beheren</a></li>
            <li><a href="boekingen.php">Boekingen bekijken</a></li>
            <li><a href="../php/logout.php">Uitloggen</a></li>
        </ul>
    </main>
</body>
</html>   
 