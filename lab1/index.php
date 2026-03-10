<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_exam";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT s.last_name, s.student_group, sub.subject_name, g.score 
            FROM grades g
            JOIN students s ON g.student_id = s.id
            JOIN subjects sub ON g.subject_id = sub.id";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <title>Відомість оцінок</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Успішність студентів (Варіант 7)</h1>
    
    <table>
        <tr>
            <th>Прізвище</th>
            <th>Група</th>
            <th>Предмет</th>
            <th>Оцінка</th>
        </tr>
        <?php foreach($results as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['last_name']) ?></td>
            <td><?= htmlspecialchars($row['student_group']) ?></td>
            <td><?= htmlspecialchars($row['subject_name']) ?></td>
            <td><?= htmlspecialchars($row['score']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="details.php?user=Denys&status=active">Перейти на сторінку деталей</a>
</body>
</html>