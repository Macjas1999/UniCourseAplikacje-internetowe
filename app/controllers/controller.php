<?php
require_once BASE_PATH . '/app/models/employee.php';
require_once BASE_PATH . '/app/controllers/authController.php';

class Controller {
    
    private $authController;
    public function __construct() {
        $this->authController = new authController();
    }
    public function handleRequest(): void
    {
        if ($_SERVER['REQUEST_URI'] == APP_NAME.'/register') {
            $this->authController->register();
        }
        if ($_SERVER['REQUEST_URI'] == APP_NAME.'/login') {
            $this->authController->login();
        }
    }
    
}
