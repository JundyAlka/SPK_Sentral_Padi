<?php
$host = '127.0.0.1';
$port = '3306';
$user = 'root';
$pass = '';

echo "Testing connection to MySQL at $host:$port...\n";

try {
    $dsn = "mysql:host=$host;port=$port";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "SUCCESS: Connected to MySQL server!\n";
    
    // List databases
    $stmt = $pdo->query("SHOW DATABASES");
    $dbs = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Available databases:\n";
    foreach ($dbs as $db) {
        echo "- $db\n";
    }

} catch (PDOException $e) {
    echo "ERROR: Could not connect to MySQL server.\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "Code: " . $e->getCode() . "\n";
    echo "Suggestion: Ensure your database server (e.g., XAMPP, MySQL) is running.\n";
}
