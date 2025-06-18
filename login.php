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
    <meta charset="UTF-8" />
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f8;
            margin: 0; padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .login-container {
            background: white;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }
        h1 {
            margin-bottom: 24px;
            color: #0077cc;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }
        button {
            background-color: #0077cc;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 1.1rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #005fa3;
        }
        .error {
            background-color: #ffcccc;
            color: #a10000;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-weight: 600;
        }
        .register-link {
            margin-top: 15px;
            font-size: 0.9rem;
        }
        .register-link a {
            color: #0077cc;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1>Inloggen</h1>

    <?php if ($foutmelding): ?>
        <div class="error"><?= htmlspecialchars($foutmelding) ?></div>
    <?php endif; ?>

    <form action="verwerk.php" method="POST" autocomplete="off">
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
