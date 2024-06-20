<?php
require_once __DIR__.'/app/config/config.php';
require_once BASE_PATH . '/app/controllers/AuthController.php';
require_once BASE_PATH . '/app/controllers/UserController.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    $_SESSION['user'] = 'none';
}
echo $_SESSION['user'];
if ($_SESSION['user'] == 'none') {
    $authController = new AuthController();
    $authController->handleRequest();
}
elseif ($_SESSION['user'] == 'user' || $_SESSION['user'] == 'admin') {
    $userController = new UserController();
    $userController->handleRequest($_SESSION['user']);
}


