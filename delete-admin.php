<?php
// Database connection
$conn = new mysqli('localhost', 'root', 'mouman321', 'red_hope_blood_bank'); // Use your actual database credentials

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data (admin_id)
$admin_id = $_POST['admin_id']; // Ensure you're passing 'admin_id' in your form

// Prepare the DELETE statement
$sql = "DELETE FROM admin WHERE admin_id = ?";

// Prepare the statement to avoid SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id); // "i" means the parameter is an integer

// Execute the statement
if ($stmt->execute()) {
    // Redirect to success page or show success message
    header("Location: admin-delete-success.html"); // Success page after deletion
    exit(); // Stop script execution after redirection
} else {
    // Show error message if deletion fails
    echo "Error deleting record: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
