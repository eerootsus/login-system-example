<?php
    session_start();
    $current_user = null;
    if (!empty($_SESSION['user'])) {
        $current_user = $_SESSION['user'];
        $hello_message = 'Tere ' . $current_user['username'];
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1><?php echo $hello_message ?? 'Tere tulemast!'; ?></h1>
        <form action="/login.php" method="post" id="login_form">
            <input type="text" name="username" placeholder="Kasutaja"><br>
            <input type="password" name="password" placeholder="Parool"><br>
            <button>Logi sisse</button>
        </form>
        <p><a href="/register.php">Registreeru</a></p>
    </body>
</html>