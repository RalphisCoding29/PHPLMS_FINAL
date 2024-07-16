
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "Libri.css">
    <title>Libri</title>
</head>
<body>
    <header class="libri-header">
        <div class="libri-logo">
            <div>
                Libri
            </div>
            <div>
                Searchbar
            </div>
        </div>
        <div class="header-menu">
            <div>
                <a href="#">XXX</a>
            </div>
            <div>
                <a href="#">aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaAAA</a>
            </div>
            <div>
                <a href="#">DDD</a>
            </div>
        </div>
    </header>

    <div>
        <div class="main-body-container">
            <div class="file-upload">
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="file" id="fileToUpload">
                    <input type="submit" value="submit">Upload file</button>
                </form>
            </div>
            
            <div class="bookshelf">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "libri_db";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM files_beta";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    echo "<h2>Uploaded Files:</h2>";
                    echo "<ul>";
                    while ($row = $result->fetch_assoc()) {
                        $filename = $row["filename"];
                        $filepath = $row["filepath"];
                        echo "<li>
                            <a href='download.php?file=" . urlencode($filename) . "'>$filename</a>
                            <a href='delete-file.php?file=". urlencode($filename)."'>Delete</a>
                        </li>";
                    }
                    echo "</ul>";
                } else {
                    echo "No files uploaded yet.";
                }
                
                $conn->close();
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>
