<?php

if (empty($_POST)) {
    header('Location: /');
    exit();
}

$users = [];

$handle = fopen("users.csv", "r");
$row_count = 0;
while (($user = fgetcsv($handle)) !== FALSE) {
    $row_count++;

    if($row_count === 1) {
        continue;
    }

    $users[] = [
        'username' => $user[0],
        'password' => $user[1],
    ];
}

$logged_in_user = false;
foreach($users as $user) {

    if ($_POST['username'] === $user['username'] && $_POST['password'] === $user['password']){
        $logged_in_user = $user;
        break;
    }

}

if (empty($logged_in_user)) {
    throw new Error('Unauthorized');
}

echo 'Hello '.$logged_in_user['username'];


