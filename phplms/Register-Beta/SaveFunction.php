<?php
    include "dbcon.php";

    if(isset($_POST['submit'])){
        $id = $_POST['idnumber'];
        $firstname = $_POST['first'];
        $mi = $_POST['mi'];
        $lastname = $_POST['last'];        
        $birth = $_POST['birth'];
        $yearsec = $_POST['Section'];
        $role = $_POST['User_Level'];
        $un = $_POST['username'];
        $pass = $_POST['pass'];
        
        if($id == NULL || $firstname == NULL || $lastname == NULL || $birth == NULL || $yearsec == NULL || $role == NULL || $un == NULL || $pass == NULL) {
            echo "All fields are required.";
            exit();
        }

        if($role == "Teacher")
        {
            echo '<form action="Admin_Check.php" method="post">';
            echo 'Additional Login:<br>';
            echo 'Username: <input type="text" name="admin_username"><br>';
            echo 'Password: <input type="password" name="admin_password"><br>';
            echo '<input type="hidden" name="idnumber" value="' . $id . '">';
            echo '<input type="hidden" name="first" value="' . $firstname . '">';
            echo '<input type="hidden" name="mi" value="' . $mi . '">';
            echo '<input type="hidden" name="last" value="' . $lastname . '">';
            echo '<input type="hidden" name="birth" value="' . $birth . '">';
            echo '<input type="hidden" name="Section" value="' . $yearsec . '">';
            echo '<input type="hidden" name="User_Level" value="' . $role . '">';
            echo '<input type="hidden" name="username" value="' . $un . '">';
            echo '<input type="hidden" name="pass" value="' . $pass . '">';
            echo '<input type="submit" name="submit" value="Confirm">';
            echo '</form>';
        }
        else{
        $check = "SELECT * FROM accs WHERE idno = '$id' OR username = '$un'";
        $result = $conn->query($check);

        if($result->num_rows > 0) {
        echo "Username or ID already in Databse, Please Try again!";
        }
            else{
                    $insert = "INSERT INTO users(`idno`, `lastname`, `firstname`, `mi`, `birthdate`, `role`, `year_section`)
                    VALUES('$id', '$lastname', '$firstname', '$mi', '$birth', '$role', '$yearsec')";

                    $result = $conn->query($insert);

                    $insert = "INSERT INTO accs(`idno`, `username`, `pass`)
                    VALUES('$id', '$un', '$pass')";
        
                    $result = $conn->query($insert);

                    if($result == TRUE){
                        $message = "Student was Successfully Saved.";
                        header('location: Register.php?notif='.$message);
                    } else {
                        $message = "Error Saving.";
                        header('location: Register.php?notif='.$message);
                    }
                }
            }   
        }
        
?>
