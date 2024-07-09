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
    <meta charset="UTF-8">
    <title>Student Election System</title>
    <link rel="icon" type="image/png" href="images/logo2.png">
    <link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="master.css">
    <style>
        body {
            background-color: #27ace854;
        }
        input {
            width: 250px;
            padding: 5px;
            margin: 5px;
            border-radius: 10px;
        }
        hr {
            align: center;
            width: 500px;
        }
        body::before {
   content: "";
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 155%;
   background: rgba(0, 0, 0, 0.25);
   z-index: -1;
}
.logo-container {
   position: absolute;
   top: 150px;
   left: 60px;
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
    <div calss="parent">
    <div class="container">
    <h3>Dashboard</h3>
    <hr>
    <?php
    $elec = $_SESSION['elec_code'];
    $id = $_SESSION['vid'];
    $db = mysqli_connect("localhost", "root", "", "StudentVote");

    $sql_user = "SELECT * FROM users WHERE id=$id";
    $result_user = mysqli_query($db, $sql_user);
    $userRow = mysqli_fetch_array($result_user, MYSQLI_ASSOC);


    $sql_election = "SELECT voted FROM election_codes WHERE user_id=$id and elec_code=$elec";
    $result_election = mysqli_query($db, $sql_election);

    if (!$result_election) {
        die("Error fetching voted status: " . mysqli_error($db));
    }

    $electionRow = mysqli_fetch_array($result_election, MYSQLI_ASSOC);
    $voted = $electionRow['voted'];
    echo "<p><b>Hello, <span style='text-transform: uppercase;'>" . $userRow['name'] . "</span></b></p>";
    echo "<p>Student ID: " . $userRow['studentId'] . "</p>";
    echo "<hr>";

    if ($voted == 1) {
        echo "<b>You have already voted.</b>";
    } else {
        echo "You have not voted. Please Vote";
        if (isset($_GET['elec_code'])) {
            echo "<h2><a href='vote.php?id=$id&elec_code=" . htmlspecialchars($_GET['elec_code']) . "'>VOTE HERE</a></h2>";
        } else {
            echo "<p>Election code is missing. Unable to display voting link.</p>";
        }
    }

    $elec_code = $_GET['elec_code'] ?? '';
    if (!empty($elec_code)) {
        echo "<div class='jumbotron'>";
        echo "<p>Election Code:</p>";
        echo "<p style='font-size: 36px; font-weight: bold;'>" . htmlspecialchars($elec_code) . "</p>";
        echo "</div>";
    }
    ?>
    <hr>
    <h3>Update Your Password</h3>
    <form action="update.php" method="post">
        <input type="text" placeholder="Enter your Student ID:" name="email3" value="<?php echo $userRow['studentId']; ?>" readonly>
        <br>
        <input type="password" placeholder=" OLD Password" name="old_pass" required>
        <br>
        <input type="password" placeholder=" NEW Password" name="new_pass" required>
        <br>
        <?php if (isset($_SESSION['error'])) { echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>"; unset($_SESSION['error']); } ?>
        <input type="submit" name="submitUpd" value="Update">
    </form>
   
    <hr>
    <h3><a href="logout.php">LOGOUT</a></h3>
    </div>
    </div>
</center>
</body>
</html>
