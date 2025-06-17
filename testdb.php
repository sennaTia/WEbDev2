<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'db.php';

try {
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tabellen in database '$dbname':<br>";
    foreach ($tables as $table) {
        echo "- " . htmlspecialchars($table) . "<br>";
    }
} catch (PDOException $e) {
    echo "Fout bij ophalen tabellen: " . $e->getMessage();
}
?>
