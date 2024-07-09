<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="images/logo2.png">
    <title>vOTING- Admin Registration</title>
    <style>
        body {
            background-color: #27ace854;
        }
        .form-container {
            width: 300px;
            margin: auto;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        .password-container {
            position: relative;
            margin: 10px 0;
        }
        .password-container input {
            padding-right: 10px;
            border: 1px solid #ccc; 
        }
        .password-container .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .password-container .toggle-password i {
            font-size: 1.2em;
        }
        hr {
            align: center;
            width: 500px;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function togglePasswordVisibility() {
            var password = document.getElementById("password");
            var icon = document.getElementById("toggle-password-icon");
            var type = password.type === "password" ? "text" : "password";
            password.type = type;
            icon.classList.toggle("fa-eye-slash");
        }
    </script>
</head>
<body>
<div class="logo-container">
        <img src="images/logo2.png" alt="Logo">
    </div>
    <center>
    <h1 class="vot">vOTING</h1>
        <div class="parent">
        <div class="container">
        <h3>Admin Registration Portal</h3>
        <hr>
        
        
        <div class="form-container">
            <form action="adminRegisterScript.php" method="post">
                <input type="text" placeholder="Username" name="username" required>
                <div class="password-container">
                    <input type="password" placeholder="Password" name="password" id="password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i id="toggle-password-icon" class="fas fa-eye"></i>
                    </span>
                </div>
                <div class="password-container">
                    <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required>
                </div>
                <input class="btn btn-primary" type="submit" name="submit" value="Register">
                
            </form>
            
        </div>
        <h3><a href="index.php">Go to HOME</a></h3>
        <hr>
        </div>
        </div>
    </center>
</body>
</html>
