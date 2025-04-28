<?php
$servername = "localhost";
$username = "root";
$password = "mouman321";
$dbname = "red_hope_blood_bank";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$blood_group = $_POST['blood_group'];
$delivery_location = $_POST['delivery_location'];
$quantity = $_POST['quantity'];
$delivered_date = $_POST['delivered_date'];

// Insert into approved_requests
$sql = "INSERT INTO approved_requests (full_name, email, phone_number, blood_group, delivery_location, quantity, delivered_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssis", $full_name, $email, $phone_number, $blood_group, $delivery_location, $quantity, $delivered_date);

if ($stmt->execute()) {
    // Redirect after success
    header("Location: request_added_successfully.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
