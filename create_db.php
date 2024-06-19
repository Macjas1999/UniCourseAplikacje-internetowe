<?php
$config = require_once './app/config/database.php';
require_once './vendor/autoload.php';
$faker = Faker\Factory::create();

try {
    $db = @new mysqli($config['host'], $config['username'], $config['password']);
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}
echo "Connected successfully<br>";

try {
    $db->query("CREATE DATABASE IF NOT EXISTS " . $config['db_name']);
}
catch (Exception $e) {
    die("Database creation failed: " . $e->getMessage());
}
echo "Database created successfully<br>";

$db->query("USE " . $config['db_name']);
$db->query("DROP TABLE IF EXISTS employees");
try {
    $db->query("CREATE TABLE IF NOT EXISTS employees (id SERIAL Primary key,
                                                            permissions VARCHAR(50) NOT NULL DEFAULT 'user',
                                                            first_name varchar(30) NOT NULL,
                                                            last_name varchar(30) NOT NULL,
                                                            birth_date date NOT NULL,
                                                            address varchar(255) NOT NULL,
                                                            telephone varchar(30) NOT NULL,
                                                            job_position varchar(30) NOT NULL,
                                                            date_started timestamp NOT NULL,
                                                            salary integer NOT NULL,
                                                            email varchar(30) NOT NULL,
                                                            password varchar(30) NOT NULL,
                                                            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                                            updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
                                                            )");
} catch (Exception $e) {
    die("Table creation failed: " . $e->getMessage());
}
echo "Table created successfully<br>";
$fake_people_amount = 10;
for ($i = 0; $i < $fake_people_amount; $i++) {
    try {
        $stmt = $db->prepare("INSERT INTO employees(first_name, last_name, birth_date, address, telephone, job_position,date_started, salary, email, password, created_at, updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
        $firstName = $faker->firstName();
        $lastName = $faker->lastName();
        $birthDate = $faker->date('Y-m-d', '2000-01-01');
        $address = $faker->address();
        $telephone = $faker->phoneNumber();
        $jobPosition = $faker->jobTitle();
        $date_started = $faker->dateTimeThisDecade()->format('Y-m-d H:i:s');
        $salary = $faker->numberBetween(3000, 10000);
        $email = $faker->email();
        $password = $faker->password();
        echo $password;
        $updated_at = $faker->dateTimeBetween($date_started, 'now')->format('Y-m-d H:i:s');
        $stmt->bind_param("sssssssissss", $firstName, $lastName, $birthDate, $address, $telephone, $jobPosition, $date_started, $salary, $email, $password, $date_started, $updated_at);
        $result = $stmt->execute();
    } catch (Exception $e) {
        die("Table insertion failed: " . $e->getMessage());
    }
}
echo "Values inserted successfully<br>";