<?php 
    include "libri_dbcon.php";

    if(isset($_POST['submit'])) {
        $admin_username = $_POST['admin_username'];
        $admin_password = $_POST['admin_password'];

        $admin_username_expected = "admin";
        $admin_password_expected = "pass";

        if ($admin_username === $admin_username_expected && $admin_password === $admin_password_expected) {
            $id = $_POST['idnumber'];
            $firstname = $_POST['first'];
            $mi = $_POST['mi'];
            $lastname = $_POST['last'];        
            $birth = $_POST['birth'];
            $yearsec = $_POST['Section'];
            $role = $_POST['User_Level'];
            $un = $_POST['username'];
            $pass = $_POST['pass'];

            $check = "SELECT * FROM accounts JOIN users USING (idno) WHERE idno = '$id' OR username = '$un'";
            $result = $conn->query($check);

            if($result->num_rows > 0) {
                echo "Username or ID already in Database, Please Try again!";
            } else {
                $insert = "INSERT INTO accounts(`idno`, `lastname`, `firstname`, `mi`, `birthdate`, `user_role`, `year_section`)
                VALUES('$id', '$lastname', '$firstname', '$mi', '$birth', '$role', '$yearsec')";

                $result = $conn->query($insert);

                $insert = "INSERT INTO users(`idno`, `username`, `password`, `user_role`)
                VALUES('$id', '$un', '$pass', '$role')";
        
                $result = $conn->query($insert);

                if($result == TRUE){
                    $message = "Teacher was Successfully Saved.";
                    header('location: Register.php?notif='.$message);
                } else {
                    $message = "Error Saving.";
                    header('location: Register.php?notif='.$message);
                }
            }
        } else {
            echo "Invalid admin credentials.";
        }
    } else {
        header('location: form_page.php');
    }
?>