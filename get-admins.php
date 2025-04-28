<?php
$servername = "localhost";
$username = "root";
$password = "mouman321";  // your MySQL password
$dbname = "red_hope_blood_bank"; // Corrected database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch all admins
$sql = "SELECT admin_id, username, email FROM admin";
$result = $conn->query($sql);

$admins = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Mask password manually (but not needed because you don't fetch it)
    $row['password'] = '••••••••'; 
    $admins[] = $row;
  }
}

// Return JSON
header('Content-Type: application/json');
echo json_encode($admins);

$conn->close();
?>
