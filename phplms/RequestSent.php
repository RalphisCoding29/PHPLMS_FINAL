<?php 
    include "libri_dbcon.php";

    if(isset($_POST['submit']))
    {
        $text = $_POST['text'];
    
        $insert = "INSERT INTO `req.beta`(`text`)
        VALUES('$text')";

        $result = $conn->query($insert);

        if($result == TRUE)
        {
            $message = "Student was Successfully Saved.";
            header('location: Student-Page-Request-beta.php?notif='.$message);
        } else
        {
            $message = "Error Saving.";
            header('location: Student-Page-Request-beta.php?notif='.$message);
        }
    }
?>
