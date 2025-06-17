<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "PHP werkt!<br>";

try {
    $host = 'db';
    $dbname = 'mydatabase';
    $user = 'user';
    $pass = 'userpassword';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Databaseverbinding OK.<br>";

    $stmt = $pdo->query("SELECT COUNT(*) FROM gebruikers");
    $aantal = $stmt->fetchColumn();

    echo "<p>Tabel <strong>'gebruikers'</strong> bestaat en bevat $aantal records.</p>";

} catch (PDOException $e) {
    echo "<p style='color:red;'>Fout: " . $e->getMessage() . "</p>";
}
?>
