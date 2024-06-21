<?php
class EmployeeModel {
    private $db;
    public function __construct($config)
    {
        try {
            $this->db = @new mysqli($config['host'], $config['username'], $config['password'], $config['db_name']);
        } catch (Exception $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    
    public function getEmployees(): array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM employees");
            $stmt->execute();
            $result = $stmt->get_result();
            $employees = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $employees;
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
        return [];
    }
    public function getEmployee($id): false|mysqli_result
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM employees WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
        return false;
    }
    public function removeEmployee($id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM employees WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return false;
    }
    public function updateEmployee($id): bool {
        try {
            $stmt = $this->db->prepare("UPDATE employees SET first_name = ? WHERE id = ?");
            $stmt->bind_param("ss", $_POST['name'], $id);
            $stmt->execute();
            $stmt->close();
            return true;
        } 
        catch (Exception $e) {
            echo $e->getMessage();
        }
        return false;
    }
}
