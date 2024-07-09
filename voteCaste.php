<?php
session_start();

if (!isset($_SESSION['vid'])) { 
    header("location: voterLogin.php"); 
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentVote";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$userId = $_SESSION['vid'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['chosen_candidate']) && isset($_POST['user_id']) && isset($_POST['elec_code'])) {
    $chosen_candidate = $_POST['chosen_candidate'];
    $user_id = $_POST['user_id'];
    $elec_code = $_POST['elec_code'];

    $stmtUpdate = $conn->prepare("UPDATE election_codes SET voted = 1 WHERE user_id = ? AND elec_code = ?");
    if (!$stmtUpdate) {
        die("Prepare failed: " . $conn->error);
    }
    $stmtUpdate->bind_param("is", $user_id, $elec_code);
    if (!$stmtUpdate->execute()) {
        die("Execute failed: " . $stmtUpdate->error);
    }
    echo "Vote has been successfully cast.";

    $stmtIncrement = $conn->prepare("UPDATE candidate SET voteCount = voteCount + 1 WHERE id = ?");
    if (!$stmtIncrement) {
        die("Prepare failed: " . $conn->error);
    }
    $stmtIncrement->bind_param("i", $chosen_candidate);
    if (!$stmtIncrement->execute()) {
        die("Execute failed: " . $stmtIncrement->error);
    }
    echo "Candidate's vote count has been incremented.";

    header("Location: voteSuccess.php");
    exit();
} else {
    echo "No candidate selected. Please go back and choose a candidate.";
}

$conn->close();
?>
