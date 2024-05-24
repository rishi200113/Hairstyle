<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <style>
        body {
            background:url(images/update.jpg);
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
        }

        table tr td {
            padding: 10px 0;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php
include("conn.php");
session_start();
$num = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = $num";
$result = mysqli_query($conn, $query);
$record = mysqli_fetch_assoc($result);

// Check if form is submitted
if(isset($_POST["submit"])) {
    $fileName = $_FILES["fileToUpload"]["name"];
    $fileType = $_FILES["fileToUpload"]["type"];
    $tmpName = $_FILES["fileToUpload"]["tmp_name"];
    $fileSize = $_FILES["fileToUpload"]["size"];
    $targetDir = "C:\xampp\htdocs\rk\prof"; // Directory where images will be stored
    $targetFile = $targetDir . basename($fileName);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($tmpName);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Try to upload file
        if (move_uploaded_file($tmpName, $targetFile)) {
            echo "The file ". basename($fileName). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>


<form action="updateD.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td><label for="upload_profile">Profile Picture</label></td>
            <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
       
        </tr>
        <tr>
            <td><label for="name">Name</label></td>
            <td><input type="text" name="name" id="name" value="<?php echo $record['fullname'] ?>"></td>
        </tr>
        <tr>
            <td><label for="email">Email</label></td>
            <td><input type="email" name="email" id="email" value="<?php echo $record['email'] ?>"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;"><input type="submit" value="Submit" name="submit"></td>
        </tr>
    </table>
</form>

</body>
</html>
