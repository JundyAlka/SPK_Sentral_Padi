<?php
$host = '127.0.0.1';
$port = '3307';
$user = 'root';
$passwords = ['', 'root', 'password', '123456', 'admin'];

foreach ($passwords as $pass) {
    try {
        $dsn = "mysql:host=$host;port=$port"; // No dbname
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "SUCCESS: Connected with password: '$pass'\n";
        exit(0);
    } catch (PDOException $e) {
         echo "Failed with '$pass': " . $e->getMessage() . "\n";
    }
}
echo "ALL FAILED\n";
