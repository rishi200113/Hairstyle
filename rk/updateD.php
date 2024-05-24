<?php

include("conn.php");
session_start();

$regno = $_POST['email'];
$name = $_POST['name'];


// if(!empty($_POST["Submit"])){
    // UPDATE MyGuests SET lastname='Doe' WHERE id=2
    $updateQuery = " UPDATE users SET email = '$regno', fullname = '$name'WHERE id = {$_SESSION['id']}";

    $result = mysqli_query($conn, $updateQuery);

    if($result) {
        header("location:show.php");
    }
    else {
        echo "update faild";
    }
// }




?>