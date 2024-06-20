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
            $_SESSION['role'] = $user['permissions'];
            
            header('Location: index.php?page=logged');
        } else {
            echo "Invalid email or password.";
        }
        $stmt->close();
    }
}
