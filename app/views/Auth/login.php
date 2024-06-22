<?php require_once BASE_PATH . '/app/views/home.php'?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Logowanie</title>
    <link rel="stylesheet" href="app/views/CSS/Log_Register.css">
</head>
<body>
<div class="container">
    <div class="modal-header">
        <h2>Logowanie</h2>
    </div>
    <br>
    <form id="login" method="post" action="">
        <input type="text" id="email" name="email" placeholder="email" required><br><br>
        <input type="password" id="password" name="password" placeholder="password" required> <br><br>
        <button class="button" type="submit">Zaloguj się</button> <br>
    </form>
</div>


</body>
</html>
