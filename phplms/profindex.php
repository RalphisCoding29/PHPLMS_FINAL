<?php
require 'config.php';

$_SESSION["id"] = 1;
$sessionId = $_SESSION["id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $sessionId"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update image</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="profindex.css">
</head>
<style media = "screen">
    .upload{
        width: 500px;
        position: relative;
        margin: auto;
        text-align: center;
    }
    .upload img{
        border-radius: 50%;
        border: 8px solid #DCDCDC;
        width: 500px;
        height: 500px;
    }
    .upload .rightRound{
        position: absolute;
        bottom: 0;
        right: 0;
        background: #0064FF;
        width: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        cursor:pointer;
    }
    .upload .leftRound{
        position: absolute;
        bottom: 0;
        left: 0;
        background: red;
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }
    .upload .fa{
        color: white;
    }
    .upload input{
        position: absolute;
        transform: scale(2);
        opacity: 0;
    }
    .upload input::-webkit-file-upload-button, .upload input[type=submit]{
        cursor: pointer;
    }

</style>
<body>
    <form class="" action="" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <div class="upload">
            <img src="img/<?php echo $user['image']; ?>" id="image">

            <div class = "rightRound" id = "upload">
                <input type="file" name="fileImg" id = "fileImg" accept = ".jpg, .jpeg, .png">
                <i class = "fa fa-camera"></i>
            </div>

            <div class="leftRound" id="cancel" style="display: none;">
                <i class = "fa fa-times"></i>
            </div>

            <div class = "rightRound" id = "confirm" style = "display: none;">
                <input type="submit" name ="" value="">
                <i class = "fa fa-check"></i>

            </div>
        </div>
    </form>

    <script type="text/javascript">
        document.getElementById('fileImg').onchange = function(){
            document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]);

            document.getElementById("cancel").style.display = "block";
            document.getElementById("confirm").style.display = "block";

            document.getElementById("upload").style.display = "none"
        }

        var userImage = document.getElementById('image').src;
        document.getElementById("cancel").onclick = function(){
            document.getElementById("image").src = userImage;

            document.getElementById("cancel").style.display = "none";
            document.getElementById("confirm").style.display = "none";

            document.getElementById("upload").style.display = "block"
        }

    </script>

    <?php
    if(isset($_FILES["fileImg"]["name"])){
        $id = $_POST["id"];

        $src = $_FILES["fileImg"]["tmp_name"];
        $imageName = uniqid() . $_FILES["fileImg"]["name"];

        $target = "img/" . $imageName;

        move_uploaded_file($src, $target);

        $query = "UPDATE tb_user SET image = '$imageName' WHERE id = $id";
        mysqli_query($conn, $query );

        header("Location: index.php");
    }
    ?>
</body>
</html>
