<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="images/logo2.png">
    <title>Student Election System - Candidate Registration</title>
    <style>
        body {
            padding-top: 100px;
            background-color: #27ace854;
        }
        input {
            padding-top: 100px;
            width: 250px;
            padding: 10px;
            margin: 5px;
            border-radius: 10px;
        }
        hr {
            align: center;
            width: 500px;
        }
        h1{
            margin-top: -20px;
        }
        body {
                color: white;
                padding-top: 50px;
            }
            .container {
              margin-top: 20px;
            }
            .parent{
                margin-top: -50px;
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
    <link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="master.css">
</head>
<body>
<div class="logo-container">
        <img src="images/logo2.png" alt="Logo">
    </div>
<h1 class="vot">vOTING</h1>
<center> </center>
    <div class="parent">
        <div class="container">
    <center>
    <h3>Candidate Registration Portal</h3>
        <hr>
        <form action="registerCandidateScript.php" method="post">
            <input type="text" placeholder="Name" name="name" required>
            <br>
            <input type="email" placeholder="Email" name="email" required>
            <br>
            <input type="text" placeholder="Contact" name="contact" required>
            <br>
            <input type="text" placeholder="Election Code" name="elec_code" required>
            <br>
            <input class="btn btn-primary" type="submit" name="submit" value="Register">
            <hr>
            <h3><a href="index.php">Go to HOME</a></h3>
        </form>
        
    </center>
    </div>
    </div>
</body>
</html>
