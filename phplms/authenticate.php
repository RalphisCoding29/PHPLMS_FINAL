<?php
include "libri_dbcon.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['login'])) {
        $username = $_POST['uname'];
        $password = $_POST['pwd'];
       
        $login = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($login);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['password'] == $password) {
                session_start();

                $_SESSION['uname'] = $row['username'];
                $_SESSION['pwd'] = $row['password'];
                $_SESSION['login'] = TRUE;

                if($row['user_role'] == 'Teacher') {
                    header('location: Admins-page.php');
                }
                else {
                    header('location: Student-page.php');
                }
            }
            else {
                $message = "Invalid password! please try again.";
                header('location: index.php?notif='.$message);
            }
        }
        else {
            $message = "This user does not exist.";
            header('location: index.php?notif='.$message);
        }
    }
}
