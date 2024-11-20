<?php
try {
    $baglanti = new PDO("mysql:host=localhost;dbname=kargonbizde", "root", "");
}
catch (PDOException $e) {
    die($e->getMessage());
}
?>