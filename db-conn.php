<?php

$sName = "localhost";
$dbName = "online-book-store-db";
$uName = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$dbName", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}
?>
