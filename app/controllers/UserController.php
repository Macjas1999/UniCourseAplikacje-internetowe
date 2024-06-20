<?php
require_once BASE_PATH . '/app/models/EmployeeModel.php';
class UserController
{
    private $employeeModel;
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel(require_once BASE_PATH . '/app/config/database.php');   
    }

    public function handleRequest($user_type) : void {
        $page = $_GET['page'] ?? 'home';
        if ($page == 'logout'){
            $this->logout();
        }
        if ($user_type == 'user') {
            $this->handleUserRequest($page);
        } elseif ($user_type == 'admin') {
            $this->handleAdminRequest($page);
        }
    }

    private function logout() {
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['permissions'] = 'none';
        header('Location: index.php');
        exit();
    }

    private function handleUserRequest($page) {
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
    }

    private function handleAdminRequest($page) {
        switch ($page) {

            case 'employee_list':
                $this->listEmployees();
                break;
            case 'employee_add':
                require_once BASE_PATH . '/app/views/Employee/add.php';
                break;
            case 'employee_edit':
                require_once BASE_PATH . '/app/views/Employee/edit.php';
                break;
            default:
                require_once BASE_PATH . '/app/views/logged.php';
                break;
        }
    }

    private function listEmployees() {
        $this->employeeModel->getEmployees();
    }
    private function addEmployee() {
        $this->employeeModel->addEmployee();
    }
    private function updateEmployee() {
        $this->employeeModel->updateEmployee();
    }
    private function removeEmployee($id) {
        $this->employeeModel->removeEmployee($id);
    }
}
