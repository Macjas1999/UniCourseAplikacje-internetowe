<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Rejestr pracowników</h1>
    <a href="<?php echo BASE_PATH . "/register"; ?>">Rejestracja</a>
    <a href="<?php echo BASE_PATH . "/login"; ?>">Login</a>
</body>
</html>

<?php
const APP_NAME = '/UniCourseAplikacje-internetowe';
define('BASE_PATH', realpath(dirname(__FILE__)));
require_once BASE_PATH . '/app/controllers/controller.php';
//require_once BASE_PATH . '/app/views/home.php';


$controller = new Controller();
$controller->handleRequest();
