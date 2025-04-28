<?php
$servername = "localhost";
$username = "root";
$password = "mouman321";
$dbname = "red_hope_blood_bank";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$full_name = $_POST['full_name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood_group'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$quantity = $_POST['quantity'];
$blood_donated = $_POST['blood_donated'];

// Prepare Insert
$sql = "INSERT INTO approved_donations (full_name, age, gender, blood_group, contact_number, email, quantity, blood_donated) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sissssis", $full_name, $age, $gender, $blood_group, $contact_number, $email, $quantity, $blood_donated);

// Now here:
if ($stmt->execute()) {
    // ✅ Add this after successful insert
    header("Location: add_donation_success.html");
    exit(); // very important to stop further code
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
