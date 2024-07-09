<?php
session_start();

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "studentvote";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['uname']) && isset($_POST['psw']) && isset($_POST['elec_code'])) {
    $myusername = $_POST['uname'];
    $mypassword = $_POST['psw'];
    $elec_code = $_POST['elec_code'];
    
    $stmt = $conn->prepare("SELECT * FROM admin WHERE elec_code = ?");
    $stmt->bind_param("s", $elec_code);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
       
        $stmt->close();
        $stmt = $conn->prepare("SELECT id FROM users WHERE studentId = ? AND pass_word = ?");
        $stmt->bind_param("ss", $myusername, $mypassword);
        $stmt->execute();
        $stmt->store_result();
        
      
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id);
            $stmt->fetch();
            
            
            $stmt->close();
            $stmt = $conn->prepare("SELECT * FROM election_codes WHERE user_id = ? AND elec_code = ?");
            $stmt->bind_param("is", $id, $elec_code);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows == 0) {
                $stmt->close();
                $stmt = $conn->prepare("INSERT INTO election_codes (user_id, elec_code) VALUES (?, ?)");
                $stmt->bind_param("is", $id, $elec_code);
                $stmt->execute();
            }

      
            $_SESSION['vid'] = $id;
            $_SESSION['elec_code'] = $elec_code;

     
            header("Location: dashboard.php?a=$id&elec_code=$elec_code");
            exit();
        } else {
           
            $error = "Your Login Name or Password is invalid";
            header("Location: voterLogin.php?error=" . urlencode($error));
            exit();
        }
    } else {
      
        $error = "Invalid election code";
        header("Location: voterLogin.php?error=" . urlencode($error));
        exit();
    }
    
   
    $stmt->close();
}


$conn->close();
?>
