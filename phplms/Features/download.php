<?php

include "libri_dbcon.php";
if(!empty($_GET["file"])) {

    $filename = isset($_GET["file"]) ? $_GET["file"] : null;
    
    $sql = "SELECT * FROM files_beta WHERE filename = '$filename'";
    $result = $conn->query($sql);


    if($result && $result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $filepath = $row["filepath"];
        //Define Headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/pdf");
        header("Content-Transfer-Encoding: binary");

        readfile($filepath);
        exit();
    } else {
        echo $filename;
        echo "This file does not exists";  
    }
    $conn->close();
} else {
    echo "No files specified";
}
?>



