<?php require_once BASE_PATH . '/app/views/home.php'?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>login</h1>
<form action="" method="post">
    <label for="email">Email użytkownika:</label>
    <input type="email" name="email" id="email" autofocus value="a@a.a"><br><br>

    <label for="password">Hasło:</label>
    <input type="password" name="password" id="password" value="123123123"><br><br>

    <input type="submit" value="Zaloguj się">
</form>
</body>
</html>
