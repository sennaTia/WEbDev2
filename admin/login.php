<?php
session_start();

// Als admin al ingelogd is → ga direct naar dashboard
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

// Toon foutmelding als die bestaat
$foutmelding = $_GET['error'] ?? '';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8" />
    <title>Admin Login</title>
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
