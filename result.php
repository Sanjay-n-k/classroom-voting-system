<?php 
session_start();
if (!isset($_SESSION['adminLoggedin'])) { 
    header("location: adminLogin.php"); 
    exit();
}
?>

<head>
    <title> Results </title>
    <link rel="icon" type="image/png" href="images/logo2.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet"> 
</head>

<?php 
if (!isset($_GET['elec_code'])) {
    echo "<h3>Election code not provided in the URL.</h3>";
    exit();
}

$elec_code = $_GET['elec_code'];


$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "studentVote";


$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT id, name, email, voteCount FROM candidate WHERE elec_code = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $elec_code);
$stmt->execute();
$result = $stmt->get_result();

$totalCandidates = $result->num_rows;
$totalVotes = 0;
while ($row = $result->fetch_assoc()) {
    $totalVotes += $row['voteCount'];
}

echo "<h1>Student Election System</h1>";
echo "<h2 style='text-align:center;'>Voting Result</h2>";
echo "<h3>Election Code: $elec_code</h3>";
echo "<h5>Total Number of candidates: $totalCandidates</h5>";
echo "<h5>Total Number of casted votes till Now: <b>$totalVotes</b></h5><br><br>";

mysqli_data_seek($result, 0);

echo "<table class='table table-striped table-bordered table-hover'>";
echo "<thead class='thead-dark'><tr><th>ID</th><th>Name</th><th>Email</th><th>Total Votes (casted)</th><th>Vote Percentage</th></tr></thead>";
echo "<tbody>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['voteCount'] . "</td>";
    echo "<td>" . round(votePercent($row['voteCount'], $totalVotes), 2) . " %</td>";
    echo "</tr>";
}

echo "</tbody></table>";

$query = "
    SELECT u.id AS userid, u.name
    FROM users u
    JOIN election_codes ec ON u.id = ec.user_id
    WHERE ec.elec_code = ? AND ec.voted = 1
";

$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $elec_code);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2 style='text-align:center;'>Users Who Have Voted</h2>";
echo "<table class='table table-striped table-bordered table-hover'>";
echo "<thead class='thead-dark'><tr><th>User ID</th><th>Name</th></tr></thead>";
echo "<tbody>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['userid'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "</tr>";
}

echo "</tbody></table>";

$stmt->close();
$conn->close();

function votePercent($castedVote, $totalVotes) {
    if ($totalVotes == 0) {
        return 0;
    }
    return $castedVote * 100 / $totalVotes; 
}
?>
        
<a href="adminLogout.php" class="btn btn-primary">LOGOUT</a>

<style type="text/css">
    body {
        padding-left: 10%;
        padding-right: 10%;
        text-align: center;
        font-family: "Secular One", serif;
    }

    h1 {
        font-size: 36px;
        font-family: "Secular One", serif;
        color: aqua;
    }

    .btn {
        padding: 5px 15px;
        background-color: #00ffd2;
        margin-top: 20px;
    }

    table {
        text-align: center;
    }
</style>
