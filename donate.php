<?php
// donate.php

// Database connection
$servername = "localhost";
$username = "root"; // Change if needed
$password = "mouman321";     // Change if needed
$database = "red_hope_blood_bank";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch form data
$full_name = $_POST['full_name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood_group'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$quantity = $_POST['quantity'];
$preferred_date = $_POST['preferred_date'];
$message = $_POST['message'];

// Insert into USER_DONATIONS
$sql = "INSERT INTO USER_DONATIONS (full_name, age, gender, blood_group, contact_number, email, quantity, preferred_date, message) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sissssiss", $full_name, $age, $gender, $blood_group, $contact_number, $email, $quantity, $preferred_date, $message);

if ($stmt->execute()) {
    // Success
    header("Location:thanku.html"); // (Create this HTML page for showing success message)
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
