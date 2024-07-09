<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "StudentVote";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo '<br><h1 style="font-size: 24px;"><center>Student Election System</center></h1>';
        echo '<script>alert("Passwords do not match. Please try again.");';
        echo 'window.location.href = "admin.php";</script>';
        exit();
    }

    $check_sql = "SELECT user_id FROM admin WHERE user_id = ?";
    if (!$stmt_check = $conn->prepare($check_sql)) {
        die("Prepare statement failed: " . $conn->error);
    }
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        echo '<br><h1 style="font-size: 24px;"><center>Student Election System</center></h1>';
        echo '<script>alert("User ID already exists. Please choose a different User ID.");';
        echo 'window.location.href = "admin.php";</script>';
        exit();
    }

    $election_code = rand(1000, 9999);

    $insert_sql = "INSERT INTO admin (user_id, pass, elec_code) VALUES (?, ?, ?)";
    if (!$stmt_insert = $conn->prepare($insert_sql)) {
        die("Prepare statement failed: " . $conn->error);
    }
    $stmt_insert->bind_param("sss", $username, $password, $election_code);

    if ($stmt_insert->execute()) {
        echo '<br><h1 style="font-size: 24px;"><center>Student Election System</center></h1>';
        echo '<h3 style="font-size: 20px;"><center>Admin registration successful</center></h3>';
        echo "<center><hr style='width: 500px;'>Admin details:<br>";
        echo "<p style='font-size: 18px;'>User ID: $username <br>";
        echo "Election Code: <strong style='font-size: 36px;'>$election_code</strong> </p><br>";
        echo "<hr></center>";
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }

    $stmt_check->close();
    $stmt_insert->close();
}

$conn->close();
?>

<style>
    hr {
        align: center;
        width: 500px;
    }
    body {
        font-size: 18px;
    }
</style>

<center>
    <a href="./index.php" style="font-size: 18px;">Home</a>
</center>

<link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="master.css">
