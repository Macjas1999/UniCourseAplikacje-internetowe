<?php

class UserController
{
    public function handleRequest($user_type) : void {
        $page = $_GET['page'] ?? 'home';
        if ($page == 'logout'){
                    session_destroy();
                    header('Location: index.php');
        }
        if ($user_type == 'user') {
            switch ($page) {
                case 'idk':
                    //
                    break;
                default:
                    require_once BASE_PATH . '/app/views/home.php';
                    break;
            }
        } elseif ($user_type == 'admin') {
            switch ($page) {
                case 'Employee_list':
                    echo 'D';
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
