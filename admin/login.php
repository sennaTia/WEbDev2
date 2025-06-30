<?php
session_start();

// Als de gebruiker al is ingelogd én admin is → stuur direct door naar dashboard
if (isset($_SESSION['gebruiker_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    header('Location: dashboard.php');
    exit;
}

// Foutmelding tonen als die bestaat
$foutmelding = $_GET['error'] ?? '';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Admin Inloggen</h1>

        <?php if ($foutmelding): ?>
            <div class="error"><?= htmlspecialchars($foutmelding) ?></div>
        <?php endif; ?>

        <form action="verwerk_login.php" method="POST" autocomplete="off">
            <input type="email" name="email" placeholder="Admin Email" required autofocus>
            <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
            <button type="submit">Inloggen</button>
        </form>
    </div>
</body>
</html>
