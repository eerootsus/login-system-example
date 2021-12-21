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

        $pdo = include_once "mysql.php";
        $sth = $pdo->prepare("INSERT INTO users (username, password) values (?, ?)");
        $created_user = $sth->execute([
                $_POST['username'],
                password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        var_dump($created_user);



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