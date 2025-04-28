<?php
$servername = "localhost";
$username = "root";
$password = "mouman321";
$dbname = "red_hope_blood_bank"; // Your DB name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$request_id = $_POST['request_id'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$blood_group = $_POST['blood_group'];
$delivery_location = $_POST['delivery_location'];
$quantity = $_POST['quantity'];
$delivered_date = $_POST['delivered_date'];

$sql = "UPDATE approved_requests 
        SET full_name=?, email=?, phone_number=?, blood_group=?, delivery_location=?, quantity=?, delivered_date=?
        WHERE request_id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssi", $full_name, $email, $phone_number, $blood_group, $delivery_location, $quantity, $delivered_date, $request_id);

if ($stmt->execute()) {
    header("Location: request_edit_success.html");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
