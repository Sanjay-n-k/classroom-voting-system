<?php
$con = mysqli_connect("localhost", "root", "", "StudentVote") or die (mysqli_error($con));

echo '<br><h2><center>Student Election System</center></h2>';
echo '<h3><center>Your details has successfully been recorded</center></h3>';

$name = $_POST["name"];
$email = $_POST["sid"];
$pass = $_POST["pass"];
$phone = $_POST["contact"];

$query = "SELECT * FROM users WHERE studentId = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Student ID already exists. Please try a different one.'); window.location.href = 'registerVoter.php';</script>";
} else {
    echo "<center><hr>Your details are:<br>";
    echo "Name : $name <br>";
    echo "Email : $email <br>";
    echo "Contact : $phone <br>";
    echo "Password : ****** <br> <hr> </center>";

    $insert_query = "INSERT INTO users (name, studentId, pass_word, mobileNumber) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($insert_query);
    $stmt->bind_param("ssss", $name, $email, $pass, $phone);
    if ($stmt->execute()) {
        echo "<h3><center>Registration successful!</center></h3>";
    } else {
        echo "<h3><center>Registration failed. Please try again.</center></h3>";
    }
}

$stmt->close();
$con->close();
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
