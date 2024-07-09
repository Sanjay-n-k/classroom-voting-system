<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "studentVote") or die (mysqli_error($con));

$email3 = $_POST["email3"];
$old_pass = $_POST["old_pass"];
$new_pass = $_POST["new_pass"];

$sql_user = "SELECT * FROM users WHERE studentId='$email3'";
$result_user = mysqli_query($con, $sql_user);
$userRow = mysqli_fetch_array($result_user, MYSQLI_ASSOC);

if ($userRow['pass_word'] != $old_pass) {
    $_SESSION['error'] = "Old password does not match. Please try again.";
    header("Location: dashboard.php");
    exit();
}

$update_query = "UPDATE users SET pass_word='$new_pass' WHERE studentId='$email3'";
$update_submit = mysqli_query($con, $update_query) or die(mysqli_error($con));


echo '<br><h1><center>Student Election System</center></h1>';
echo '<h3><center>Your password has been successfully updated.</center></h3>';
echo "<center><hr>";
echo "Student ID: $email3 <br>";
echo "Password: ****** (Not shown for security reasons)<br>";
echo "<hr></center>";
?>
<center>
    <h3><a href="dashboard.php">Go to Dashboard</a></h3>
</center>
<link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="master.css">
