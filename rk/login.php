<?php
session_start(); // Start the session

include("conn.php");

$name = $_POST['username'];
$password = $_POST['password'];

$checkad = false;
$checkuse = false;

if ($conn) {
    // Admin
    $slect_query = "SELECT * FROM Login";
    $result = mysqli_query($conn, $slect_query);
    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_assoc($result)) {
            if ($name === $record['username'] && $password === $record['password']) {
                $checkad = true;
                $_SESSION['username'] = $name; // Set the username to a session variable
            }
        }
    }

    // User
    $slect_query = "SELECT * FROM users ";
    $result = mysqli_query($conn, $slect_query);
    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_assoc($result)) {
            if ($name === $record['email'] && $password === $record['password']) {
                $checkuse = true;
                $_SESSION['username'] = $name; // Set the username to a session variable
            }
        }
    }
}

if ($checkad)  header("location:show.php");
if ($checkuse) header("location:user.php");
else {
    echo "Login Fail";
}
?>
