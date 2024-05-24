
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .logout-btn {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div>
    


    
        <h2>Welcome to Your Dashboard</h2>
        <p><h1>Hello!BRO</h1></p>
        <a href="login.html" class="logout-btn">Log Out</a>
    </div>
    

    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
            include("conn.php");
            session_start(); // Start the session

            // Check if the username is set in the session
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $selectQuery = "SELECT * FROM users WHERE email = '$username'";
                $result = mysqli_query($conn, $selectQuery);
                if(mysqli_num_rows($result) > 0){
                    while($record = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>".$record['fullname']."</td>";
                        echo "<td>".$record['email']."</td>";
                        echo "<td><a href='update.php?username={$record['email']}'>Update</a></td>";
                        echo "</tr>";
                    }
                }
            } else {
                header("location: login.php");
                exit(); 
            }
        ?>
    </table>
</body>
</html>
