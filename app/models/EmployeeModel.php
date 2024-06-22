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
    public function getEmployee($id): false|array|null
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM employees WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
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
    public function updateEmployee($data): bool {
        try {
            $query = "UPDATE employees SET
                     permissions = ?,
                      first_name = ?, 
                      last_name = ?, 
                      birth_date = ?, 
                      address = ?, 
                      telephone = ?, 
                      job_position = ?, 
                      date_started = ?, 
                      salary = ?, 
                      email = ?, 
                      updated_at = NOW() 
                      WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ssssssssssssi",
                              $data["permissions"],
                              $data['first_name'], 
                              $data['last_name'], 
                              $data['birth_date'], 
                              $data['address'], 
                              $data['telephone'], 
                              $data['job_position'], 
                              $data['date_started'], 
                              $data['salary'], 
                              $data['email'],
                              $data['id']);
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