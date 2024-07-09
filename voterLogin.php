<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> voter login</title>
<link rel="icon" type="image/png" href="images/logo2.png">
<link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="master.css">
<style>
              h1{
                margin-top: -20px;
            }
            body {
                color: white;
                padding-top: 50px;
            }
            .container {
              margin-top: -60px;
            }
input[type=text], input[type=password] {
  width: 79%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: white;
  color: black;
  padding: 14px 20px;
  margin: 8px 0;
  border:black;
  cursor: pointer;
  width: 29%;
}

a {
  display: inline-block;
  margin-top: 20px;
  text-decoration: none;
  color: black;
}

a:hover {
  text-decoration: underline;
}
body::before {
   content: "";
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background: rgba(0, 0, 0, 0.25); 
   z-index: -1;
}
.logo-container {
   position: absolute;
   top: 150px;
   left: 70px;
}
.logo-container img {
   height: 300px; 
}
.vot
{
    font-size: 80px;
}
</style>
</head>
<body>
<div class="logo-container">
        <img src="images/logo2.png" alt="Logo">
    </div>
<center>
<h1 class="vot">vOTING</h1>

</center>

<form action="loginSubmit.php" method="post">
 <div class="parent">
  <div class="container">
  <h2>Voter Login Form</h2>
<hr>
    <label for="uname"><b>Voter  ID</b></label><br>
    <input type="text" placeholder="Enter StudentID" name="uname" required>
    <br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <br>
    <label for="elec_code"><b>Election Code</b></label>
    <input type="text" placeholder="Enter Election Code" name="elec_code" required>
    <br>
        <button type="submit">Login</button><br />
    <a href="registerVoter.php">New User? Register</a><br>
    <hr>
    <a href="index.php">Go to Home</a>
    <br>
    <hr>
    <mark><?php if (isset($_GET['error'])) { echo $_GET['error']; } ?></mark>
  </div>
 </div>
</form>
</body>
</html>
