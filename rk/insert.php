<?php

include("conn.php");


$regno = $_POST['regno'];
$name = $_POST['name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];

// if(!empty($_POST["Submit"])){
    $insertQuery = "INSERT INTO reg(regno, name, dob, gender) VALUES ('$regno', '$name', '$dob', '$gender')";
    $result = mysqli_query($conn, $insertQuery);

    if($result) {
        header("location:show.php");
    }
    else {
        echo "insert faild";
    }
// }




?>