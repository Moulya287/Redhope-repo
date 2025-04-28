<?php
$servername = "localhost";
$username = "root";
$password = "mouman321";
$dbname = "red_hope_blood_bank";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT * FROM approved_donations";
$result = $conn->query($sql);

$donations = [];

if ($result) {
    $donations = $result->fetch_all(MYSQLI_ASSOC); // Faster
}

header('Content-Type: application/json');
echo json_encode($donations);

$conn->close();
?>
