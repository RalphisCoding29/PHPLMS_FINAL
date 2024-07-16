<?php
if(isset($_GET['id'])) {
    $conn = mysqli_connect("localhost", "root", "", "teacher_files");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM files WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $file = 'uploads/' . $row['filename'];
        if (file_exists($file)) {
            unlink($file);
        }

        $sql = "DELETE FROM files WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid file.";
    }

    mysqli_close($conn);
}
?>