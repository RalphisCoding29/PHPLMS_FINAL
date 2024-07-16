<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Table</title>
</head>
<body>
    <h2>Student Table</h2>
    <table border="1">
        <tr>
            <th>File Name</th>
            <th>Download</th>
        </tr>
        <?php include 'display_files.php'; ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>