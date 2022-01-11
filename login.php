<?php

session_start();
unset($_SESSION['user']);

if (empty($_POST)) {
    header('Location: /');
    exit();
}

$pdo = include_once "mysql.php";

$logged_in_user = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$logged_in_user->execute([$_POST['username']]);
$logged_in_user = $logged_in_user->fetch(PDO::FETCH_ASSOC);

if (empty($logged_in_user)) {
    $error_message = 'Vale kasutajanimi või parool. Proovi uuesti.';
    include 'error.php';
    exit();
}

$_SESSION['user'] = $logged_in_user;
header('Location: /');
exit();
