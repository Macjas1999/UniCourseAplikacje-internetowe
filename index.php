<?php
// Plik wejściowy, który przekierowuje żądania do odpowiedniego kontrolera

require_once 'controller.php';

$controller = new Controller();
$controller->handleRequest();