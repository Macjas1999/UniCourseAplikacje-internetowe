<?php require_once BASE_PATH . '/app/views/home.php'?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rejestracja</title>
</head>
<body>
<form action="" method="post">

    <link rel="stylesheet" href="app/views/CSS/Log_Register.css">
    </head>
    <body>
    <div class="container">
        <div class="modal-header">
            <h2>Rejestracja</h2>
        </div>
        <br>
        <form id="register" method="post" action="">
            <input type="text" id="email" name="email" placeholder="email" required><br><br>
            <input type="password" id="password" name="password" placeholder="password" required><br><br>
            <button class="button" type="submit">Zarejestruj się</button> <br>
            <a href="<?php echo APP_NAME . "/?page=login"; ?>">Login</a>

        </form>
    </div>
</form>
</body>
</html>