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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $elec_code = $_POST['elec_code']; 

   
    $validate_sql = "SELECT elec_code FROM admin WHERE elec_code = ?";
    $stmt_validate = $conn->prepare($validate_sql);
    $stmt_validate->bind_param("s", $elec_code);
    $stmt_validate->execute();
    $stmt_validate->store_result();

    if ($stmt_validate->num_rows == 0) {
       
        echo '<br><h1><center>Student Election System</center></h1>';
        echo '<script>alert("Invalid election code. Please enter a valid election code.");';
        echo 'window.location.href = "registerCandidate.php";</script>';
    } else {
       
        $sql = "INSERT INTO candidate (name, email, contact, elec_code) VALUES (?, ?, ?, ?)";
    
      
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $contact, $elec_code);

        if ($stmt->execute()) {
            echo '<br><h1><center>Student Election System</center></h1>';
            echo '<h3><center>Your details have successfully been recorded</center></h3>';
            echo "<center><hr>"."Your details are:<br> ";
            echo "Name : $name <br>";
            echo "Email : $email <br>";
            echo "Contact : $contact <br>";
            echo "Election Code : $elec_code <br>";
            echo "<hr> </center>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }

    $stmt_validate->close();
}

$conn->close();
?>

<style>
    hr {
        align: center;
        width: 500px;
    }
</style>

<center>
    <a href="./index.php">Home</a>
</center>

<link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="master.css">
