<?php
	class User {
		private $db;

		public function __construct($dbConfig) {
			try {
				$this->db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['db_name']);
			} catch(Exception $e) {
				die("Błędne połączenie z bazą danych: " . $e->getMessage());
			}
		}

		public function create($username, $city_id, $password, $email, $birthday) {
			$hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
			$stmt = $this->db->prepare("INSERT INTO users (username, city_id, password, email, birthday) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param("sisss", $username, $city_id, $password, $email, $birthday);
			$result = $stmt->execute();
			$stmt->close();
			return $result;
		}

	}