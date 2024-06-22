<?php
require_once BASE_PATH . '/app/models/EmployeeModel.php';

class UserController
{
    private EmployeeModel $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel(require_once BASE_PATH . '/app/config/database.php');
    }

    public function handleRequest($user_type): void
    {
        $page = $_GET['page'] ?? 'home';

        if ($page == 'logout') {
            $this->logout();
        }
        if ($page == 'view_profile') {
            $this->viewProfile();
        }
        if ($user_type == 'user') {
            $this->handleUserRequest();
        } elseif ($user_type == 'admin') {
            $this->handleAdminRequest($page);
        }
    }

    private function logout(): void
    {
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['permissions'] = 'none';
        header('Location: index.php');
        exit();
    }

    private function handleUserRequest(): void
    {
        require_once BASE_PATH . '/app/views/logged.php';
    }

    private function handleAdminRequest($page): void
    {
        switch ($page) {
            case 'employee_list':
                $this->listEmployees();
                break;
            case 'employee_add':
                $this->addEmployee();
                break;
            case 'employee_edit':
                $this->updateEmployee();
                break;
            case 'employee_remove':
                $this->removeEmployee();
                break;
            default:
                require_once BASE_PATH . '/app/views/logged.php';
                break;
        }
    }

    private function listEmployees(): void
    {
        $employees = $this->employeeModel->getEmployees();
        require_once BASE_PATH . '/app/views/Employee/indexAdmin.php';
    }

    private function updateEmployee(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $employee = $this->employeeModel->getEmployee($id);
                require_once BASE_PATH . '/app/views/Employee/edytuj.php';
            } else {
                require_once BASE_PATH . '/app/views/logged.php';
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->sanitizeInput($_POST);
            $errors = $this->validateEmployeeData($data);

            if (empty($errors)) {
                $this->employeeModel->updateEmployee($data);
            } else {
                foreach ($errors as $error) {
                    echo $error.'<br>';
                }
            }

            header('Location: index.php?page=employee_list');
        }
    }

    private function addEmployee(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once BASE_PATH . '/app/views/Employee/add.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->sanitizeInput($_POST);
            $errors = $this->validateEmployeeData($data);

            if (empty($errors)) {
                $this->employeeModel->addEmployee($data);
                require_once BASE_PATH . '/app/views/Employee/add.php';
            } else {
                foreach ($errors as $error) {
                    echo $error . '<br>';
                }
            }
        }
    }

    private function removeEmployee(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id && $id != $_SESSION['id']) {
            $this->employeeModel->removeEmployee($id);
        }
        header('Location: index.php?page=employee_list');
    }

    private function sanitizeInput(array $input): array
    {
        $sanitized = [];
        foreach ($input as $key => $value) {
            $sanitized[$key] = htmlspecialchars($value);
        }
        return $sanitized;
    }

    private function validateEmployeeData(array $data): array
    {
        $errors = [];

        if (empty($data['permissions']) || ($data['permissions'] != 'user' && $data['permissions'] != 'admin')) {
            $errors['permissions'] = 'Permissions allowed are user and admin';
        }

        foreach (['first_name', 'last_name', 'birth_date', 'address', 'telephone', 'job_position', 'date_started', 'salary', 'email'] as $field) {
            if (empty($data[$field])) {
                $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' is required';
            }
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Valid email is required';
        }

        return $errors;
    }

    private function viewProfile(): void
    {
        $id = $_SESSION['user_id'] ?? null;
        if ($id) {
            console_log($id);
            $employee = $this->employeeModel->getEmployee($id);
            require_once BASE_PATH . '/app/views/Employee/viewProfile.php';
        } else {
            require_once BASE_PATH . '/app/views/logged.php';
        }
    }
}
