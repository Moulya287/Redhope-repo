<?php
$servername = "localhost";
$username = "root";
$password = "mouman321";  // your password
$dbname = "red_hope_blood_bank"; // corrected database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect POST data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone'];  // sent as 'phone' from form
$blood_group = $_POST['blood_group'];
$delivery_location = $_POST['location'];  // sent as 'location' from form
$quantity = $_POST['quantity'];
$date_needed = $_POST['date_requested'];  // sent as 'date_requested' from form
$additional_info = $_POST['message'];  // sent as 'message' from form

// Prepared statement to insert safely
$sql = "INSERT INTO user_requests (
    full_name, email, phone_number, blood_group, delivery_location, quantity, date_needed, additional_info
) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $full_name, $email, $phone_number, $blood_group, $delivery_location, $quantity, $date_needed, $additional_info);

if ($stmt->execute()) {
    header("Location: thankyou.html"); // redirect after success
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
