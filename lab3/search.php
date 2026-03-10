<?php
require 'db.php';

$search_results = [];
$search_type = $_GET['search_type'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($search_type)) {
    
    // 1. Пошук за ключовим словом (Точний збіг по групі)
    if ($search_type == 'keyword' && !empty($_GET['group'])) {
        $stmt = $pdo->prepare("SELECT * FROM students WHERE student_group = ?");
        $stmt->execute([$_GET['group']]);
        $search_results = $stmt->fetchAll();
    }
    
    // 2. Пошук за шаблоном (Частина прізвища)
    if ($search_type == 'pattern' && !empty($_GET['name_part'])) {
        $name_part = '%' . $_GET['name_part'] . '%'; // Добавляем % для SQL LIKE
        $stmt = $pdo->prepare("SELECT * FROM students WHERE last_name LIKE ?");
        $stmt->execute([$name_part]);
        $search_results = $stmt->fetchAll();
    }
    
    // 3. Пошук у заданому діапазоні (Оцінки від і до)
    if ($search_type == 'range' && !empty($_GET['min_score']) && !empty($_GET['max_score'])) {
        $sql = "SELECT s.last_name, sub.subject_name, g.score 
                FROM grades g
                JOIN students s ON g.student_id = s.id
                JOIN subjects sub ON g.subject_id = sub.id
                WHERE g.score BETWEEN ? AND ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_GET['min_score'], $_GET['max_score']]);
        $search_results = $stmt->fetchAll();
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Пошук</title></head>
<body>
    <h2>Пошук по базі даних</h2>

    <table border="0" cellpadding="10">
        <tr>
            <td valign="top">
                <h4>1. За ключовим словом (Група)</h4>
                <form method="GET">
                    <input type="hidden" name="search_type" value="keyword">
                    <input type="text" name="group" placeholder="Наприклад: IP-33" required>
                    <button type="submit">Знайти</button>
                </form>
            </td>
            
            <td valign="top">
                <h4>2. За шаблоном (Частина прізвища)</h4>
                <form method="GET">
                    <input type="hidden" name="search_type" value="pattern">
                    <input type="text" name="name_part" placeholder="Наприклад: Харк" required>
                    <button type="submit">Знайти</button>
                </form>
            </td>

            <td valign="top">
                <h4>3. У діапазоні (Оцінки)</h4>
                <form method="GET">
                    <input type="hidden" name="search_type" value="range">
                    Від: <input type="number" name="min_score" min="1" max="5" required style="width: 50px;">
                    До: <input type="number" name="max_score" min="1" max="5" required style="width: 50px;">
                    <button type="submit">Знайти</button>
                </form>
            </td>
        </tr>
    </table>

    <hr>

    <h3>Результати:</h3>
    <?php if (!empty($search_results)): ?>
        <table border="1" cellpadding="5">
            <?php foreach ($search_results as $row): ?>
                <tr>
                    <?php foreach ($row as $key => $value): ?>
                        <td><b><?= htmlspecialchars($key) ?>:</b> <?= htmlspecialchars($value) ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($search_type)): ?>
        <p>Нічого не знайдено.</p>
    <?php endif; ?>

    <br>
    <a href="index.php">На головну</a>
</body>
</html>