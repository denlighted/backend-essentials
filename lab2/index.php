<?php
require 'db.php';

$sort_by = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC';

$allowed_columns = ['id', 'last_name', 'student_group', 'ticket_number'];
if (!in_array($sort_by, $allowed_columns)) {
    $sort_by = 'id';
}

$stmt = $pdo->query("SELECT * FROM students ORDER BY $sort_by $order");
$students = $stmt->fetchAll();

$next_order = $order === 'ASC' ? 'desc' : 'asc';
?>

<!DOCTYPE html>
<html>
<head><title>Students</title></head>
<body>
    <h2>Student List</h2>
    <a href="add.php">Add Student</a>
    <br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th><a href="?sort=id&order=<?= $next_order ?>">ID</a></th>
            <th><a href="?sort=last_name&order=<?= $next_order ?>">Last Name</a></th>
            <th><a href="?sort=student_group&order=<?= $next_order ?>">Group</a></th>
            <th><a href="?sort=ticket_number&order=<?= $next_order ?>">Ticket Number</a></th>
            <th>Actions</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= htmlspecialchars($student['id']) ?></td>
            <td><?= htmlspecialchars($student['last_name']) ?></td>
            <td><?= htmlspecialchars($student['student_group']) ?></td>
            <td><?= htmlspecialchars($student['ticket_number']) ?></td>
            <td>
                <a href="edit.php?id=<?= $student['id'] ?>">Edit</a> | 
                <a href="delete.php?id=<?= $student['id'] ?>" onclick="return confirm('Delete student?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>