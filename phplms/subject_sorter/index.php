<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher's File Upload</title>
</head>
<body>
    <h2>Upload Files</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select subject:
        <select name="subject">
            <option value="GEC">GEC</option>
            <option value="Math">Math</option>
            <option value="Programming">Programming</option>
            <option value="Elex">Elex</option>
        </select><br><br>
        Select file to upload:
        <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
        <input type="submit" value="Upload File" name="submit">
    </form>

    <h2>Uploaded Files</h2>
    <form action="" method="post">
        <button type="submit" name="filter" value="GEC">Filter by GEC</button>
        <button type="submit" name="filter" value="Math">Filter by Math</button>
        <button type="submit" name="filter" value="Programming">Filter by Programming</button>
        <button type="submit" name="filter" value="Elex">Filter by Elex</button>
        <button type="submit" name="filter" value="">Show All</button>
    </form>
    
    <table border="1">
        <tr>
            <th>Subject</th>
            <th>File Name</th>
            <th>Action</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "teacher_files");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if(isset($_POST['filter'])) {
            $subject = $_POST['filter'];
            if ($subject !== '') {
                $sql = "SELECT * FROM files WHERE subject='$subject'";
            } else {
                $sql = "SELECT * FROM files";
            }
        } else {
            $sql = "SELECT * FROM files";
        }

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['subject']."</td>";
                echo "<td>".$row['filename']."</td>";
                echo "<td><a href='download.php?id=".$row['id']."'>Download</a> | <a href='delete.php?id=".$row['id']."'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No files uploaded yet.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher's File Upload</title>
</head>
<body>
    <h2>Upload Files</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select subject:
        <select name="subject">
            <option value="GEC">GEC</option>
            <option value="Math">Math</option>
            <option value="Programming">Programming</option>
            <option value="Elex">Elex</option>
        </select><br><br>
        Select file to upload:
        <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
        <input type="submit" value="Upload File" name="submit">
    </form>

    <h2>Uploaded Files</h2>
    <form action="" method="post">
        <button type="submit" name="filter" value="GEC">Filter by GEC</button>
        <button type="submit" name="filter" value="Math">Filter by Math</button>
        <button type="submit" name="filter" value="Programming">Filter by Programming</button>
        <button type="submit" name="filter" value="Elex">Filter by Elex</button>
        <button type="submit" name="filter" value="">Show All</button>
    </form>
    
    <table border="1">
        <tr>
            <th>Subject</th>
            <th>File Name</th>
            <th>Action</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "teacher_files");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if(isset($_POST['filter'])) {
            $subject = $_POST['filter'];
            if ($subject !== '') {
                $sql = "SELECT * FROM files WHERE subject='$subject'";
            } else {
                $sql = "SELECT * FROM files";
            }
        } else {
            $sql = "SELECT * FROM files";
        }

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['subject']."</td>";
                echo "<td>".$row['filename']."</td>";
                echo "<td><a href='download.php?id=".$row['id']."'>Download</a> | <a href='delete.php?id=".$row['id']."'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No files uploaded yet.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
>>>>>>> 9d35ae0518d674c1426c78663061ed62f9a72d64
