<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';

function checkUser($db, $host, $user, $pass) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $stmt = $pdo->query("SELECT count(*) FROM users WHERE email = 'admin@gmail.com'");
        if ($stmt) {
            $count = $stmt->fetchColumn();
            echo "Database [$db]: Found $count users with email 'admin@gmail.com'.\n";
        } else {
            echo "Database [$db]: users table not found or query failed.\n";
        }
    } catch (PDOException $e) {
        echo "Database [$db]: Error - " . $e->getMessage() . "\n";
    }
}

checkUser('spk_sentral_padi', $host, $user, $pass);
checkUser('spk_padi', $host, $user, $pass);
