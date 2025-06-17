<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $wachtwoord = $_POST['wachtwoord'] ?? '';

    if (!$email || !$wachtwoord) {
        header('Location: login.php?error=Vul email en wachtwoord in');
        exit;
    }

    // Zoek gebruiker op email
    $stmt = $pdo->prepare("SELECT id, naam, email, wachtwoord_hash FROM gebruikers WHERE email = ?");
    $stmt->execute([$email]);
    $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$gebruiker) {
        header('Location: login.php?error=Onjuiste login gegevens');
        exit;
    }

    // Controleer wachtwoord (aangenomen dat wachtwoord_hash bcrypt is)
    if (!password_verify($wachtwoord, $gebruiker['wachtwoord_hash'])) {
        header('Location: login.php?error=Onjuiste login gegevens');
        exit;
    }

    // Login OK, start sessie
    $_SESSION['gebruiker_id'] = $gebruiker['id'];
    $_SESSION['naam'] = $gebruiker['naam'];
    $_SESSION['email'] = $gebruiker['email'];

    header('Location: account.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}
