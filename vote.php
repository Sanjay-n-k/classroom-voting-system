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
    <link rel="icon" type="image/png" href="images/logo2.png">
    <title>Student Election System</title>
    <link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet">
    <style>
        body {
            background-color: white;
            font-family: "Secular One", serif;
            text-align: center;
            max-width: 750px;
            margin-right: auto;
            margin-left: auto;
        } 
        h1 {
            color: aqua;
        }
        .btn {
            padding: 5px 15px;
            background-color: #00ffd2;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Student Election System</h1>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentVote";

$elec_code = $_GET['elec_code'] ?? '';

if (!empty($elec_code)) {
    echo "<div class='jumbotron'>";
    echo "<p>Election Code:</p>";
    echo "<p style='font-size: 36px; font-weight: bold;'>" . htmlspecialchars($elec_code) . "</p>";
    echo "</div>";
}

echo "<h2>Please vote for your candidate.</h2>";
echo "<h2>Registered Candidates are:</h2>";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$userId = $_SESSION['vid'];

$sql = "SELECT id, name, email FROM candidate WHERE elec_code='$elec_code'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form action='voteCaste.php' method='POST'>";
    echo "<table class='table'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td><input type='radio' name='chosen_candidate' value='" . $row['id'] . "'></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<input type='hidden' name='user_id' value='$userId'>";
    echo "<input type='hidden' name='elec_code' value='$elec_code'>";
    echo "<input type='submit' value='Vote Now' class='btn'>";
    echo "</form>";
} else {
    echo "No candidates found for this election code.";
}

$conn->close();
?><center>  <h3 href="index.php">Go to Home</h3></center>

</body>
</html>
