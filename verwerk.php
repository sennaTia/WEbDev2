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
        header('Location: account.php');
        exit;
    } else {
        echo "❌ Ongeldige inloggegevens.";
    }
}
?>
