<?php
require_once BASE_PATH . '/app/models/UserModel.php';
class authController {
    private $userModel;
    public function __construct()
    {
        console_log('ctrlConstr');
        $this->userModel = new userModel(require BASE_PATH . '/app/config/database.php');
    }

    private function register(): void
    {
        $errors = [];
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data['password'] = htmlspecialchars(trim($_POST['password']));
            $data['email'] = htmlspecialchars(trim($_POST['email']));
            
            if (empty($data['password']) || strlen($data['password']) < 8) {
                $errors['password'] = 'Hasło nie spełnia wymagań';
            }

            if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email jest nieprawidłowy';
            }
            

            if (empty($errors)) {
                //$hash = password_hash($data['password'], PASSWORD_ARGON2ID);
                $this->userModel->register($data['email'], $data['password']);
            }
            else {
                print_r($errors);
            }
        }

        require_once BASE_PATH . '/app/views/Auth/register.php';
    }
    private function login(): void
    {
        console_log('loginCtrl');
        require_once BASE_PATH . '/app/views/Auth/login.php';
        $errors = [];
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            console_log('login post');
            $data['email'] = htmlspecialchars(trim($_POST['email']));
            $data['password'] = htmlspecialchars(trim($_POST['password']));


            if (empty($data['email'])) {
                $errors['username'] = 'Nazwa użytkownika jest pusta';
            }

            if (empty($data['password'])) {
                $errors['password'] = 'Hasło użytkownika jest puste';
            }



            if (empty($errors)) {
                // $hash = password_hash($data['password'], PASSWORD_ARGON2ID);
                // $this->userModel->create($data['username'], $data['city'], $hash, $data['email'], $data['birthday']);
                $email = $_POST['email'];
                $password = $_POST['password'];
                $this->userModel->login($email, $password);
            } else{
                print_r($errors);
            }
        }

        
    }
    public function handleRequest(): void {
        $page = $_GET['page'] ?? 'home';
        
        
        switch ($page) {
            case 'register':
                $this->register();
                break;
            case 'login':
                $this->login();
                break;
            default:
                require_once BASE_PATH . '/app/views/home.php';
                break;
        }
    }
}