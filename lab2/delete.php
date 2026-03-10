<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$id]);
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        die("Delete Error: Possibly, this student has grades in the grades table. Please delete them first. <br><br> Details: " . $e->getMessage() . "<br><br><a href='index.php'>Back</a>");
    }
} else {
    header("Location: index.php");
    exit;
}
?>