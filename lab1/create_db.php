<?php
$servername = "localhost";
$username = "root"; 
$password = "";    
$dbname = "students_exam";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    
    $conn->exec($sql);
    
    echo "Database '$dbname' successfully created!";
} catch(PDOException $e) {
    echo "Error database creation: " . $e->getMessage();
}

$conn = null;
?>