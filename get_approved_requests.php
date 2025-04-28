<?php
$servername = "localhost";
$username = "root";
$password = "mouman321";
$dbname = "red_hope_blood_bank"; // Make sure spelling correct

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all from approved_requests
$sql = "SELECT * FROM approved_requests";
$result = $conn->query($sql);

$requests = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($requests);

$conn->close();
?>
