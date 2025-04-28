<?php
// change-password.php

// Database connection
$servername = "localhost"; // or your server name
$username = "root";         // your database username
$password = "mouman321";             // your database password
$dbname = "red_hope_blood_bank";      // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch form data
$admin_id = $_POST['admin_id'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Check if new passwords match
if ($new_password !== $confirm_password) {
    echo "New passwords do not match.";
    exit();
}

// Fetch the current password from database
$sql = "SELECT password FROM admin WHERE admin_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Admin ID not found.";
    exit();
}

$row = $result->fetch_assoc();

// Verify the current password
if ($row['password'] !== $current_password) {
    echo "Current password is incorrect.";
    exit();
}

// Update the password
$update_sql = "UPDATE admin SET password = ? WHERE admin_id = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("ss", $new_password, $admin_id);

if ($update_stmt->execute()) {
    header("Location: password-changed.html");
    exit();
    
} else {
    echo "Error updating password: " . $conn->error;
}

// Close connection
$conn->close();
?>
