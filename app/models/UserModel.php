<?php
class UserModel {
    private mysqli $db;

    public function __construct($config) {
        try {
            $this->db = @new mysqli($config['host'], $config['username'], $config['password'], $config['db_name']);
        } catch (Exception $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function login($email, $password) {
        session_start();
        $stmt = $this->db->prepare("SELECT * FROM employees WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user && $password ===  $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['permissions'] = $user['permissions'];

            $stmt->close();
            header('Location: index.php?page=logged');
        } else {
            echo "Invalid email or password.";
        }
    }
    
    public function register($email, $password) {
        session_start();
        $stmt = $this->db->prepare("INSERT INTO employees (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        
        //get id of inserted data
        $user_id = $stmt->insert_id;
        
        
        $stmt = $this->db->prepare("SELECT * FROM employees WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['permissions'] = $user['permissions'];
            header('Location: index.php?page=logged');
        } else {
            echo "Registration failed.";
        }
        
        $stmt->close();
    }
}