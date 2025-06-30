<?php
session_start();
require '../php/db.php'; // pad naar je db.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $wachtwoord = $_POST['wachtwoord'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && $wachtwoord === $admin['wachtwoord']) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_naam'] = $admin['naam'];
        header('Location: dashboard.php');
        exit;
    } else {
        header('Location: login.php?error=Ongeldige+inloggegevens');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}
?>
