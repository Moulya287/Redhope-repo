<?php
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "mouman321";
$dbname = "red_hope_blood_bank"; // Correct database name

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Check password match
if ($password !== $confirmPassword) {
    echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
    exit();
}

// No hashing — store password as plain text
$insert_sql = "INSERT INTO admin (username, email, password) VALUES (?, ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("sss", $username, $email, $password);

if ($insert_stmt->execute()) {
    header("Location: admin-success.html"); // Redirect after success
    exit();
} else {
    echo "<script>alert('Error: " . $insert_stmt->error . "'); window.history.back();</script>";
}

$insert_stmt->close();
$conn->close();
?>
