<?php 
    include "dbcon.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form action="SaveFunction.php" method="post">
        <table>
            <tr>
                <td ><input type="text" placeholder="ID Number" name="idnumber"></td>
            </tr>
            <tr>
                <td ><input type="text" placeholder="First Name" name="first"></td>
            </tr>
            <tr>
                <td><input type="text" placeholder="Middle Initial" name="mi"></td>
            </tr>
            <tr>
                <td><input type="text" placeholder="Last Name" name="last"></td>
            </tr>
            <tr>
                <td>
                    <input type="date" name="birth">
                </td>
            </tr>
            <tr>
                <td><input type="text" placeholder="Username" name="username"></td>
            </tr>
            <tr>
                <td><input type="text" placeholder="Password" name="pass"></td>
            </tr>
            <tr>
                <td colspan="2"> 
                    <label for="User_Level">Role:</label>
                    <select name="User_Level" id="User_Level">
                        <option value=Student>Student</option>
                        <option value=Teacher>Teacher</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="Section">Section:</label>
                    <select name="Section" id="Section">
                        <option value="CpE1A">BSCpE-1A</option>
                        <option value="CpE2A">BSCpE-2A</option>
                        <option value="CpE3A">BSCpE-3A</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <input type="submit" value="Register" name="submit">
                </td>
            </tr>
        </table>
    </form>
    <br>
    <table width="80%" border="1">
            <thead>
                <th>ID Number</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>MI</th>
                <th>Birth Date</th>
                <th>Role</th>
                <th>Year & Sec.</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM users ORDER BY lastname";
                $result = $conn->query($sql);

                if($result->num_rows > 0){
                while($row=$result->fetch_assoc())
                {
                ?>                
                <tr class=".table-striped">
                    <td><?php echo $row['idno']?>
                    <td><?php echo $row['lastname']  ?></td>
                    <td><?php echo $row['firstname']  ?></td>
                    <td><?php echo $row['mi']  ?></td>
                    <td><?php echo $row['birthdate']  ?></td>
                    <td><?php echo $row['role'] ?></td>
                    <td><?php echo $row['year_section']  ?></td>
                </tr>
                <?php
                        }
                    }        
                ?>
            </tbody>
        </table>
</body>
</html>