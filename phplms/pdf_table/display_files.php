<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pdf_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM pdf_files";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["file_name"]."</td>";
        echo "<td><a href='download.php?file=".$row["id"]."'>Download</a></td>";

        if (isset($_SESSION['role']) && $_SESSION['role'] == 'teacher') {
            echo "<td><a href='delete.php?file=".$row["id"]."'>Delete</a></td>";
        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No files uploaded yet.</td></tr>";
}

$conn->close();
?>