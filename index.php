
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Rejestr pracowników</h1>
</body>
</html>

<?php
define('BASE_PATH', realpath(dirname(__FILE__)));
require_once __DIR__ . '/app/controllers/controller.php';
$controller = new Controller();
$controller->handleRequest();