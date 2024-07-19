<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_system";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function pang kwa total items sang quiz
function getTotalItems($quiz_id, $conn) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS total_items FROM questions WHERE quiz_id = ?");
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $stmt->bind_result($total_items);
    $stmt->fetch();
    $stmt->close();
    
    return $total_items;
}
?>
