<?php
session_start();

if (!isset($_SESSION['vid'])) { 
    header("location: voterLogin.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vote Success</title>
    <link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet"> 
    <style>
        body {
            font-family: "Secular One", serif;
            text-align: center;
            max-width: 750px;
            margin-right: auto;
            margin-left: auto;
            background-color: white;
        }
        h1 {
            color: aqua;
        }
        .btn {
            padding: 5px 15px;
            background-color: #00ffd2;
        }
    </style>
</head>
<body>
    <h1>Student Election System</h1>
    <h2>Your vote has been successfully cast!</h2>
    <a href="dashboard.php" class="btn">Go to Dashboard</a>
</body>
</html>