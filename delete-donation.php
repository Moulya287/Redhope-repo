<?php
$servername = "localhost";
$username = "root";
$password = "mouman321";
$dbname = "red_hope_blood_bank";

// Connect
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$donation_id = intval($_POST['donation_id']);

// Delete record
$sql = "DELETE FROM approved_donations WHERE donation_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $donation_id);

if ($stmt->execute()) {
    header("Location: delete_donation_success.html"); // ✅ redirect after delete
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
