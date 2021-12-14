<?php
$pdo = null;
$servername = "db";
$username = "user";
$password = "password";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=login", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    die();
}

return $pdo;
