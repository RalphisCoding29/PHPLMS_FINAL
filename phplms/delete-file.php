<?php
include "libri_dbcon.php";
$filename = $_GET["file"];

$delete = "DELETE FROM `pdf-files` WHERE `pdf-name` = '$filename'";
$result = $conn->query($delete);

if($result==TRUE) {
    $message = "Deleted";
    }
?>