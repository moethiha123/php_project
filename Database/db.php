<?php
require "config.php";
//dsn dtat source name
$dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($pdo) {
        // echo "db connected";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}