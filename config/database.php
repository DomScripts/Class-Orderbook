<?php

$hostname = "localhost";
$port = 3306;
$dbname = "class_orderbook";
$user = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$hostname;port=$port;dbname=$dbname;charset=utf8mb4", $user, $password);
    $conn->SetAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>
