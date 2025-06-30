<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $wachtwoord = $_POST['wachtwoord'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM gebruikers WHERE email = :email");
    $stmt->execute([':email' => $email]);

    $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($gebruiker && $wachtwoord === $gebruiker['wachtwoord']) {
        // Inloggen gelukt
        $_SESSION['gebruiker_id'] = $gebruiker['id'];
        $_SESSION['naam'] = $gebruiker['naam'];
        $_SESSION['is_admin'] = $gebruiker['is_admin'];

        if ($gebruiker['is_admin'] == 1) {
            header('Location: /admin/dashboard.php');
        } else {
            header('Location: /account.php');
        }
        exit;
    } else {
        header('Location: /login.php?error=Ongeldige+inloggegevens');
        exit;
    }
}
?>