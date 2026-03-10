<?php
require 'db.php';

// 1. Скільки всього було зроблено записів у першій таблиці (students)
$stmt = $pdo->query("SELECT COUNT(*) as count FROM students");
$total_students = $stmt->fetch()['count'];

// 2. Скільки було зроблено записів у другій таблиці (grades)
$stmt = $pdo->query("SELECT COUNT(*) as count FROM grades");
$total_grades = $stmt->fetch()['count'];

// 3. Скільки записів було зроблено за останній місяць
$stmt = $pdo->query("SELECT COUNT(*) as count FROM students WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)");
$students_last_month = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) as count FROM grades WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)");
$grades_last_month = $stmt->fetch()['count'];

// 4. Який запис був зроблений останнім (у табл.1)
$stmt = $pdo->query("SELECT * FROM students ORDER BY created_at DESC, id DESC LIMIT 1");
$last_student = $stmt->fetch();

// 5. Який запис у табл.1 має найбільшу кількість пов’язаних записів у табл. 2
// Ищем студента, у которого больше всего выставленных оценок
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
<head><title>Статистика сайту</title></head>
<body>
    <h2>Статистика бази даних</h2>
    <ul>
        <li>Всього студентів (Таблиця 1): <b><?= $total_students ?></b></li>
        <li>Всього оцінок (Таблиця 2): <b><?= $total_grades ?></b></li>
        <li>Додано студентів за останній місяць: <b><?= $students_last_month ?></b></li>
        <li>Додано оцінок за останній місяць: <b><?= $grades_last_month ?></b></li>
    </ul>

    <h3>Останній доданий студент:</h3>
    <?php if ($last_student): ?>
        <p><?= htmlspecialchars($last_student['last_name']) ?> (Група: <?= htmlspecialchars($last_student['student_group']) ?>)</p>
    <?php else: ?>
        <p>Немає даних</p>
    <?php endif; ?>

    <h3>Студент з найбільшою кількістю оцінок:</h3>
    <?php if ($top_student): ?>
        <p><?= htmlspecialchars($top_student['last_name']) ?> — Оцінок: <b><?= $top_student['grades_count'] ?></b></p>
    <?php else: ?>
        <p>Немає даних</p>
    <?php endif; ?>
    
    <br>
    <a href="index.php">На головну</a>
</body>
</html>