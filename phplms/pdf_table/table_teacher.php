<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Table</title>
</head>
<body>
    <h2>Teacher Table</h2>
    <table border="1">
        <tr>
            <th>File Name</th>
            <th>Download</th>
            <th>Delete</th>
        </tr>
        <?php include 'display_files.php'; ?>
    </table>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select PDF file to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload PDF" name="submit">
    </form>
    <a href="logout.php">Logout</a>
</body>
</html>