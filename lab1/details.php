<!DOCTYPE html>
<html lang="uk">
<head>
    <title>Детальна інформація</title>
</head>
<body>
    <h1>Додаткова інформація</h1>

    <?php
    if (isset($_GET['user'])) {
        $name = htmlspecialchars($_GET['user']);
        $status = htmlspecialchars($_GET['status']);
        echo "<p>Вітаємо, <strong>$name</strong>! Ваш статус: <strong>$status</strong>.</p>";
    } else {
        echo "<p>Дані не отримані.</p>";
    }
    ?>

    <br>
    <a href="index.php">Повернутися до списку оцінок</a>
</body>
</html>