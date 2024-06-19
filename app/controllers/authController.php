<?php

class authController {
    public function register(): void
    {
        require_once BASE_PATH . '/app/views/Auth/register.php';
    }
    public function login(): void
    {
        require_once BASE_PATH . '/app/views/Auth/login.php';
    }
    
}