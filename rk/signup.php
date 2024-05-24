<!DOCTYPE html>
<html>
<head>
    <title>My PHP Page with SweetAlert2</title>
    <!-- Include SweetAlert2 from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 
        }
    </style>
</head>
<body>
<?php



include("conn.php");

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if email already exists
$sql_check = "SELECT * FROM users WHERE email='$email'";
$result_check = $conn->query($sql_check);
if ($result_check->num_rows > 0) {
    echo "Email already exists, please choose another one.";
} else {
    // Insert data into users table
    $sql_insert = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";

    if ($conn->query($sql_insert) === TRUE) {
        // JavaScript alert for successful creation
        
        
        echo '<script>Swal.fire({
            title: "Welcome puppy ma !",
            text: "Account created Buddy",
            imageUrl: "images/login3.jpg",
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image",
            confirmButtonColor: "#e1a6ef"
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "login.html"; 
            }
          });</script>';
        
        
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}
//header("location:login.html");

// Close connection
$conn->close();
?>
</body>
</html>
