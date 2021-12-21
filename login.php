<?php

session_start();
unset($_SESSION['user']);

if (empty($_POST)) {
    header('Location: /');
    exit();
}

$pdo = include_once "mysql.php";

$logged_in_user = $pdo->query("SELECT * FROM users ORDER BY id DESC LIMIT 1")->fetch();

if (empty($logged_in_user)) {
    $error_message = 'Vale kasutajanimi või parool. Proovi uuesti.';
    include 'error.php';
    exit();
}

$_SESSION['user'] = $logged_in_user;
header('Location: /');
exit();
