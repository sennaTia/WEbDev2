<?php
// Zet foutmeldingen aan
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "PHP werkt!<br>";

// Probeer verbinding te maken met DB
try {
    $host = 'db';
    $dbname = 'mydatabase';
    $user = 'user';
    $pass = 'userpassword';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Databaseverbinding OK.<br>";

    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    echo "<h2>Tabellen in database '$dbname':</h2><ul>";
    foreach ($tables as $table) {
        echo "<li>" . htmlspecialchars($table) . "</li>";
    }
    echo "</ul>";

} catch (PDOException $e) {
    echo "Fout bij verbinding of query: " . $e->getMessage();
}
?>
