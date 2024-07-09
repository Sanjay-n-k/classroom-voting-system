<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['loginbtn'])) {
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "studentvote";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $username = $_POST['username'];
    $password = $_POST['pass'];

    $stmt = $conn->prepare("SELECT user_id, elec_code FROM admin WHERE user_id = ? AND pass = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
       
        $stmt->bind_result($user_id, $elec_code);
        $stmt->fetch();

        $_SESSION['adminLoggedin'] = "ok";
        $_SESSION['user_id'] = $user_id; 
        $_SESSION['elec_code'] = $elec_code;

        $stmt->close();

        header("Location: result.php?elec_code=$elec_code");
        exit();
    } else {
        echo "<script>alert('Invalid Credentials.')</script>";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="icon" type="image/png" href="images/logo2.png">
    <style type="text/css">
        body {
            text-align: center;
        }

        .container {
            margin-top: -60px;
                        border: 20px solid #e4e4e4;
            padding-bottom: 5%;
            padding-right: 5%;
            padding-left: 5%;
            display: inline-block;
            border-radius: 20px;
        }

        input {
            padding: 5px;
            border-radius: 5px;
            margin: 10px;
            width: 200px;
        }

        form {
            border: 5px solid #c1ded0;
            padding: 15px;
            display: inline-block;
            border-radius: 10px;
        }

        h2 {
            color: blue;
        }

        table {
            width: 50%;
            margin: auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        body {
                color: white;
                padding-top: 50px;
            }
            input {
                width: 250px;
                padding: 10px;
                margin: 5px;
                margin-top: 20px;
                border-radius: 10px;
            }
            hr {
                align: center;
                width: 500px;
            }
            h1{
                margin-top: -10px;
            }
            .logo-container {
   position: absolute;
   top: 150px;
   left: 60px;
}
.logo-container img {
   height: 300px; 
}
.vot
{
    font-size: 80px;
}
    </style>
    <link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="master.css">
</head>
<body>
<div class="logo-container">
        <img src="images/logo2.png" alt="Logo">
    </div>
    <h1 class="vot">vOTING</h1>
<div class="parent">
<div class="container">
    <h2>Login to Admin Panel</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <br>
        <input type="password" name="pass" placeholder="Password" required>
        <br>
        <input type="submit" name="loginbtn" value="Login">
    </form>
    <p><a href="index.php">Go to Home</a></p>
</div>
</div>
</body>
</html>
