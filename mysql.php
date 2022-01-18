<?php
$_pdo = null;
$_servername = "db";
$_username = "user";
$_password = "password";

try {
    $_pdo = new PDO("mysql:host=$_servername;dbname=login", $_username, $_password);
    // set the PDO error mode to exception
    $_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    die();
}

return $_pdo;
