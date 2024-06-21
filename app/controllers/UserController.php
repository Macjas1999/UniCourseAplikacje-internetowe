<?php
require_once BASE_PATH . '/app/models/EmployeeModel.php';
class UserController
{
    private EmployeeModel $employeeModel;
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

    private function handleUserRequest($page): void
    {
        switch ($page) {
            case 'idk':
                //
                break;
            default:
                require_once BASE_PATH . '/app/views/logged.php';
                break;
        }
    }

    private function handleAdminRequest($page): void
    {
        switch ($page) {
            case 'employee_list':
                $this->listEmployees();
                break;
            case 'employee_add':
                require_once BASE_PATH . '/app/views/Employee/add.php';
                break;
            case 'employee_edit':
                $this->updateEmployee();
                break;
            default:
                require_once BASE_PATH . '/app/views/logged.php';
                break;
        }
    }

    private function listEmployees(): void
    {
        $employees = $this->employeeModel->getEmployees();
        require_once BASE_PATH . '/app/views/Employee/list.php';
    }

    private function updateEmployee(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $employee = $this->employeeModel->getEmployee($id);
                require_once BASE_PATH . '/app/views/Employee/edit.php';
            } else {
                require_once BASE_PATH . '/app/views/logged.php';
            }
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST as $key => $value) {
                $data[$key] = htmlspecialchars($value);
            }
            $errors = [];
            
            if (empty($data) || $data['permissions'] != 'user' || $data['permissions'] != 'admin') {
                $errors['permissions'] = 'Permissions allowed are user and admin';
            }
            if (empty($data['first_name'])) {
                $errors['first_name'] = 'First name is required';
            }
            if (empty($data['last_name'])) {
                $errors['last_name'] = 'Last name is required';
            }
            if (empty($data['birth_date'])) {
                $errors['birth_date'] = 'Birth date is required';
            }
            if (empty($data['address'])) {
                $errors['address'] = 'Address is required';
            }
            if (empty($data['telephone'])) {
                $errors['telephone'] = 'Telephone is required';
            }
            if (empty($data['job_position'])) {
                $errors['job_position'] = 'Job position is required';
            }
            if (empty($data['date_started'])) {
                $errors['date_started'] = 'Date started is required';
            }
            if (empty($data['salary'])) {
                $errors['salary'] = 'Salary is required';
            }
            if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Valid email is required';
            }

            if (empty($errors)) {
                $this->employeeModel->updateEmployee($data);
            }
            else {
                print_r($errors);
            }
            header('Location: index.php?page=employee_list');
        }
    }

    private function addEmployee() {
        $this->employeeModel->addEmployee();
    }

    private function removeEmployee($id) {
        $this->employeeModel->removeEmployee($id);
    }
}
