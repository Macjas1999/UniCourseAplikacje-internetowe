<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Rejestr pracowników</h1>
    <h2>asd</h2>
</body>
</html>

<?php
const APP_NAME = '/UniCourseAplikacje-internetowe';
define('BASE_PATH', realpath(dirname(__FILE__)));
require_once BASE_PATH . '/app/controllers/controller.php';


$controller = new Controller();
$controller->handleRequest();
