<?php
    session_start();
    if (!empty($_SESSION['user'])) {
        header('Location: /');
        exit();
    }

    if (!empty($_POST)) {

        if (empty($_POST['username']) || empty($_POST['password'])) {
            $error_message = 'Kasutajanimi ega parool ei tohi olla tühjad!';
            include 'error.php';
            exit();
        }

        $_POST['username'] = htmlspecialchars($_POST['username']);

        $pdo = include_once "mysql.php";

        $user_check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $user_check->execute([$_POST['username']]);

        if ($user_check->fetch() !== false) {
            $error_message = 'Selline kasutaja on juba olemas. Vali uus kasutajanimi.';
            include 'error.php';
            exit();
        }

        $sth = $pdo->prepare("INSERT INTO users (username, password) values (?, ?)");
        $created_user = $sth->execute([
                $_POST['username'],
                password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        header('Location: /');
        exit();
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Tere tulemast võõras!</h1>
        <form action="/register.php" method="post" id="register_form">
            <input type="text" name="username" placeholder="Kasutaja"><br>
            <input type="password" name="password" placeholder="Parool"><br>
            <button>Registreeru</button>
        </form>
        <p><a href="/">Tagasi avalehele</a></p>
    </body>
</html>