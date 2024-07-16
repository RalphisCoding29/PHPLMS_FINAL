<?php 
    include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request</title>
</head>
<body>
    <h2>Want to Request?</h2>
    <form action="RequestSent.php" method="post">
        <table>
            <textarea name="text" rows="7" cols="50" style="resize: none"></textarea>
            <br>
            <input type="submit" value="Send Request"name="submit">
        </table>
    </form>

    <table width="80%" border="1">
            <thead>
                <th>Req. Number</th>
                <th>ID Number</th>
                <th>Name</th>
                <th>Request</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT reqno, idno, `text` FROM `req.beta` ORDER BY reqno ASC";
                $result = $conn->query($sql);

                if($result->num_rows > 0){
                while($row=$result->fetch_assoc())
                {
                ?>                
                <tr class=".table-striped">
                    <td><?php echo $row['reqno']?></td>
                    <td><?php echo $row['idno']?></td>
                    <td><?php echo $row['fullname']?></td>
                    <td><?php echo $row['text']?></td>
                    
                </tr>
                <?php
                        }
                    }        
                ?>
            </tbody>
        </table>
</body>
</html>