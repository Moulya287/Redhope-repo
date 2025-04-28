<?php
$servername = "localhost";
$username = "root";
$password = "mouman321";
$dbname = "red_hope_blood_bank"; // Fixed database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user_donations WHERE action IS NULL"; // Pending donations only
$result = $conn->query($sql);

$donations = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $donations[] = $row;
  }
}

header('Content-Type: application/json');
echo json_encode($donations);

$conn->close();
?>
