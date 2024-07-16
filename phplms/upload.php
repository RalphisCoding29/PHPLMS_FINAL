<?php
include "libri_dbcon.php";

//target directory
$targetDir = "uploads/";

//check if the file was uploaded
if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $sub = $_POST['subject'];
    $code = $_POST['pdf-code'];
    
    $targetPath = $targetDir.$fileName;

    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetPath)) {

        $fileName = $conn->real_escape_string($fileName);
        $sub = $conn->real_escape_string($sub);
        $code = $conn->real_escape_string($code);
        

        $sql = "INSERT INTO `pdf-files` (`pdf-name`, `pdf-sub`, `pdf-code`) VALUES ('$fileName', '$sub', '$code')";
        if($conn->query($sql) == true) {
            $message = "File uploaded and saved to Database";
            
            // Add a notification for the new file
            $notifMessage = "A new file '$fileName' has been added to the library. Check it out!";
            $notifMessage = $conn->real_escape_string($notifMessage);
            $notifSql = "INSERT INTO notifications (message) VALUES ('$notifMessage')";
            if ($conn->query($notifSql) === TRUE) {
                echo "Notification added successfully";
            } else {
                echo "Error: " . $notifSql . "<br>" . $conn->error;
            }

            // Delete notifications older than 10 days
            $deleteOldNotifSql = "DELETE FROM notifications WHERE created_at < NOW() - INTERVAL 10 DAY";
            if ($conn->query($deleteOldNotifSql) === TRUE) {
                echo "Old notifications deleted successfully";
            } else {
                echo "Error: " . $deleteOldNotifSql . "<br>" . $conn->error;
            }

            header('location: Admins-Page.php?notif='.$message);
        }
        else {
            echo "Error: ".$sql." Error Details: ".$conn->error;
        }
    }
    else {
        echo "Error moving the file";
    }
}
else {
    echo "File not uploaded.";
}

$conn->close();

