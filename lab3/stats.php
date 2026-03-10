<?php
require 'db.php';

$stmt = $pdo->query("SELECT COUNT(*) as count FROM students");
$total_students = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) as count FROM grades");
$total_grades = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) as count FROM students WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)");
$students_last_month = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) as count FROM grades WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)");
$grades_last_month = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT * FROM students ORDER BY created_at DESC, id DESC LIMIT 1");
$last_student = $stmt->fetch();

$sql = "SELECT s.last_name, s.student_group, COUNT(g.id) as grades_count 
        FROM students s 
        LEFT JOIN grades g ON s.id = g.student_id 
        GROUP BY s.id 
        ORDER BY grades_count DESC LIMIT 1";
$stmt = $pdo->query($sql);
$top_student = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head><title>Web Site Statistics</title></head>
<body>
    <h2>Web Site Statistics</h2>
    <ul>
        <li>Total Students (Table 1): <b><?= $total_students ?></b></li>
        <li>Total Grades (Table 2): <b><?= $total_grades ?></b></li>
        <li>Students Added Last Month: <b><?= $students_last_month ?></b></li>
        <li>Grades Added Last Month: <b><?= $grades_last_month ?></b></li>
    </ul>

    <h3>Last added student:</h3>
    <?php if ($last_student): ?>
        <p><?= htmlspecialchars($last_student['last_name']) ?> (Group: <?= htmlspecialchars($last_student['student_group']) ?>)</p>
    <?php else: ?>
        <p>No data available</p>
    <?php endif; ?>

    <h3>Student with the most grades:</h3>
    <?php if ($top_student): ?>
        <p><?= htmlspecialchars($top_student['last_name']) ?> — Grades: <b><?= $top_student['grades_count'] ?></b></p>
    <?php else: ?>
        <p>No data available</p>
    <?php endif; ?>
    
    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>