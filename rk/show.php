<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: 40px;
            
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color:rgba(139, 243, 227, 0.721);
        }

        tr:hover {
            background-color: #f5f5f5;
        }
        
    
        .navbar-brand {
            font-weight: bold;
            font-size: 20px;
           
        }

        .navbar-nav .nav-link {
            font-size: 18px;
        }
        .navbar-nav .nav-link:hover {
        color: black; 
    }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(139, 243, 227, 0.721); padding:10px; margin-left: 18px; width: 98%;">
    <a class="navbar-brand" href="#">CUSTOMERS DETAILS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.html">Log Out <span class="sr-only">(Home)</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="sign.html">Insert details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Show.php">Show Details</a>
            </li>
        </ul>
    </div>
</nav>
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>UPDATE</th>
        <th>DELETE</th>
    </tr>
    <?php
//ob_start(); // Start output buffering
session_start();
include("conn.php");

$selectQuery = "SELECT * FROM users";
$result = mysqli_query($conn, $selectQuery);
if(mysqli_num_rows($result) > 0){
    while($record = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$record['fullname']."</td>";
        echo "<td>".$record['email']."</td>";
        echo "<td><a href='?key={$record['id']}' class='btn btn-primary'>UPDATE</a></td>";
        echo "<td><form method='GET' action='" . $_SERVER["PHP_SELF"] . "'><button type='submit' name='id' value='{$record['id']}' class='btn btn-danger'>DELETE</button></form></td>";
        echo "</tr>";
    }
}

if(!empty($_GET["id"])){
    $deleteQuery = "DELETE FROM users WHERE id = '{$_GET['id']}'";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    if($deleteResult){
        header("location:show.php");
        exit;
    }
    else{
        echo "delete failed";
    }
}
if (!empty($_GET["key"])) {
   $_SESSION['id'] = $_GET["key"];
    header("location: update.php");
}
//ob_end_flush(); // Flush the output buffer
?>

</table>
</body>
</html>
