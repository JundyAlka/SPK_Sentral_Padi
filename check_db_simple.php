<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=spk_sentral_padi', 'root', '');
    echo "Koneksi Berhasil!";
} catch (PDOException $e) {
    echo "Koneksi Gagal: " . $e->getMessage();
}
