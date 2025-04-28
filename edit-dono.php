<?php
$servername = "localhost";
$username = "root";
$password = "mouman321";
$dbname = "red_hope_blood_bank"; // your correct database

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$donation_id = $_POST['donation_id'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$contact_number = $_POST['contact_number'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood_group'];
$blood_donated = $_POST['blood_donated'];
$quantity = $_POST['quantity'];

// Prepare Update Query
$sql = "UPDATE approved_donations 
        SET full_name=?, email=?, contact_number=?, age=?, gender=?, blood_group=?, blood_donated=?, quantity=?
        WHERE donation_id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssisssii", $full_name, $email, $contact_number, $age, $gender, $blood_group, $blood_donated, $quantity, $donation_id);

// Execute Update
if ($stmt->execute()) {
    // ✅ Redirect to success page
    header("Location: edit_donation_success.html");
    exit();
} else {
    echo "Error updating donation: " . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
