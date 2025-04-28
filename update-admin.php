<?php
// Database connection
$conn = new mysqli('localhost', 'root', 'mouman321', 'red_hope_blood_bank'); // change your_database_name

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$admin_id = $_POST['admin_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Only update the fields that are filled
$updates = [];

if (!empty($username)) {
    $updates[] = "username = '$username'";
}
if (!empty($email)) {
    $updates[] = "email = '$email'";  // ✅ correct
}

if (!empty($password)) {
    $updates[] = "password = '$password'";
}

// Check if there is something to update
if (count($updates) > 0) {
    $sql = "UPDATE admin SET " . implode(", ", $updates) . " WHERE admin_id = $admin_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin-edit-success.html"); // ✅ Success page
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "<script>alert('No fields to update.'); window.location.href='ManageAd.html';</script>";
}

$conn->close();
?>
