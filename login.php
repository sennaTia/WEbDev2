<?php
session_start();

if (isset($_SESSION['gebruiker_id'])) {
    header('Location: account.php');
    exit;
}

$foutmelding = $_GET['error'] ?? '';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
      <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8" />
    <title>Login</title>
</head>
<body>

<div class="login-container">
    <h1>Inloggen</h1>

    <?php if ($foutmelding): ?>
        <div class="error"><?= htmlspecialchars($foutmelding) ?></div>
    <?php endif; ?>

    <form action="php/verwerk.php" method="POST" autocomplete="off">
        <input type="email" name="email" placeholder="Email" required autofocus>
        <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
        <button type="submit">Inloggen</button>
    </form>
    <div class="register-link">
        Nog geen account? <a href="register.php">Registreer hier</a>
    </div>
</div>

</body>
</html>