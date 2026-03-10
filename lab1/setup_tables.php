<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "students_exam"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql1 = "CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        last_name VARCHAR(50) NOT NULL,
        student_group VARCHAR(10) NOT NULL,
        ticket_number VARCHAR(20) UNIQUE NOT NULL
    )";
    $conn->exec($sql1);

    $sql2 = "CREATE TABLE IF NOT EXISTS subjects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        subject_name VARCHAR(100) NOT NULL,
        teacher VARCHAR(100) NOT NULL
    )";
    $conn->exec($sql2);

    $sql3 = "CREATE TABLE IF NOT EXISTS grades (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_id INT,
        subject_id INT,
        score INT CHECK (score >= 1 AND score <= 5),
        FOREIGN KEY (student_id) REFERENCES students(id),
        FOREIGN KEY (subject_id) REFERENCES subjects(id)
    )";
    $conn->exec($sql3);

    echo "Tables successfully created!";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>