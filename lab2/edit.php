<?php
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) die("ID is not specified");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $last_name = $_POST['last_name'];
    $student_group = $_POST['student_group'];
    $ticket_number = $_POST['ticket_number'];

    $sql = "UPDATE students SET last_name = ?, student_group = ?, ticket_number = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$last_name, $student_group, $ticket_number, $id]);
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        $error = "Update Error: " . $e->getMessage();
    }
}

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if (!$student) die("Student not found");
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Editing Student</h2>
    <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        Last Name: <input type="text" name="last_name" value="<?= htmlspecialchars($student['last_name']) ?>" required><br><br>
        Group: <input type="text" name="student_group" value="<?= htmlspecialchars($student['student_group']) ?>" required><br><br>
        Ticket Number: <input type="text" name="ticket_number" value="<?= htmlspecialchars($student['ticket_number']) ?>" required><br><br>
        <button type="submit">Save</button>
    </form>
    <br>
    <a href="index.php">Cancel</a>
</body>
</html>