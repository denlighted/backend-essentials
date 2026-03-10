<?php
$servername = "localhost";
$root_user = "root";
$root_pass = "";

try {
    $conn = new PDO("mysql:host=$servername", $root_user, $root_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $new_user = "student_user";
    $new_pass = "password123";
    
    $sql = "CREATE USER IF NOT EXISTS '$new_user'@'localhost' IDENTIFIED BY '$new_pass';";
    $conn->exec($sql);
    
    $sql_grant = "GRANT ALL PRIVILEGES ON *.* TO '$new_user'@'localhost';";
    $conn->exec($sql_grant);

    echo "User $new_user successfully created by script!";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>