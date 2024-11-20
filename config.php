<?php
try { //VERİTABANI BAĞLANTISI
    $baglanti = new PDO("mysql:host=localhost;dbname=kargonbizde", "root", "");
}
catch (PDOException $e) { //VERİTABANI BAĞLANTISI BAŞARISIZ OLURSA ÇALIŞACAK KOD
    die($e->getMessage());
}
?>