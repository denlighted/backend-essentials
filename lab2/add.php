<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $last_name = $_POST['last_name'];
    $student_group = $_POST['student_group'];
    $ticket_number = $_POST['ticket_number'];

    $sql = "INSERT INTO students (last_name, student_group, ticket_number) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$last_name, $student_group, $ticket_number]);
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        $error = "Adding Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Adding a student</h2>
    <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        Last Name: <input type="text" name="last_name" required><br><br>
        Group: <input type="text" name="student_group" required><br><br>
        Ticket Number: <input type="text" name="ticket_number" required><br><br>
        <button type="submit">Add Student</button>
    </form>
    <br>
    <a href="index.php">Back to List</a>
</body>
</html>