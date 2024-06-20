<?php
require_once __DIR__.'/app/config/config.php';
require_once BASE_PATH . '/app/controllers/AuthController.php';
require_once BASE_PATH . '/app/controllers/UserController.php';

session_start();
//session_destroy();

if (!isset($_SESSION['permissions'])) {
    $_SESSION['permissions'] = 'none';
}
print_r($_SESSION);
if ($_SESSION['permissions'] == 'none') {
    $authController = new AuthController();
    $authController->handleRequest();
}
elseif ($_SESSION['permissions'] == 'user' || $_SESSION['permissions'] == 'admin') {
    $userController = new UserController();
    $userController->handleRequest($_SESSION['permissions']);
}


