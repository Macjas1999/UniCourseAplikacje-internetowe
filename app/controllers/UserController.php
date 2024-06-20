<?php

class UserController
{
    public function handleRequest($user_type) : void {
        $page = $_GET['page'] ?? 'home';
        if ($page == 'logout'){
            session_destroy();
            session_start();
            $_SESSION['permissions'] = 'none';
            header('Location: index.php');
            exit();
        }
        if ($user_type == 'user') {
            switch ($page) {
                case 'logged':
                    require_once BASE_PATH . '/app/views/logged.php';
                    break;
                case 'idk':
                    //
                    break;
                default:
                    //
                    break;
            }
        } elseif ($user_type == 'admin') {
            switch ($page) {
                case 'logged':
                    require_once BASE_PATH . '/app/views/logged.php';
                    break;
                case 'Employee_list':
                    require_once BASE_PATH . '/app/views/Employee/list.php';
                    break;
                case 'Employee_add':
                    require_once BASE_PATH . '/app/views/Employee/add.php';
                    break;
                case 'Employee_edit':
                    require_once BASE_PATH . '/app/views/Employee/edit.php';
                    break;
                default:
                    require_once BASE_PATH . '/app/views/home.php';
                    break;
            }
        }
    }
}