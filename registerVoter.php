<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home | Student Voting System</title>
        <link rel="icon" type="image/png" href="images/logo2.png">
        <link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet"> 
        <style>
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
        <link rel="stylesheet" type="text/css" href="master.css">
    </head>
    <body>
    <div>
    <div class="logo-container">
        <img src="images/logo2.png" alt="Logo">
    </div>
    <h1 class="vot">vOTING</h1>
        <div class="parent">
        <div class="container">
        <h3>New User Registration</h3>
        <hr>
        <form action="registerVoterScript.php" method="post">
            <input type="text" placeholder="Name" name="name">
            <br>
            <input type="text" placeholder="StudentId" name="sid">
            <br>
            <input type="password" placeholder="Password" name="pass">
            <br>
            <input type="text" placeholder="Contact" name="contact">
            <br>
            <input class="btn btn-primary" type="submit" name="submit" value="Register">
        </form>
        <br>
        <h3>Already have an account? <a href="voterLogin.php">Login here</a></h3>
        <hr>
        <h3> <a href="index.php">Goto HOME</a></h3>
       
        </div>
        </div>
    </center>
    </body>
</html>
