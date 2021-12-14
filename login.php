<?php

session_start();

if (empty($_POST)) {
    header('Location: /');
    exit();
}

$pdo = include_once "mysql.php";

$logged_in_user = $pdo->query("SELECT * FROM users ORDER BY id DESC LIMIT 1")->fetch();

if (empty($logged_in_user)) {
    $error_message = 'Wrong username or password; Please try again!';
    include 'error.php';
    exit();
}

$_SESSION['user'] = $logged_in_user;
header('Location: /');
exit();
