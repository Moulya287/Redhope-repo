<?php
$servername = "localhost";
$username = "root";
$password = "mouman321";
$dbname = "red_hope_blood_bank"; // ✅ your correct database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = intval($_POST['id']); // Always make ID integer for safety
$action = $_POST['action'];

if ($action === 'Approve') {
    // Insert into approved_requests table
    $insertSql = "INSERT INTO approved_requests (
        full_name, email, phone_number, blood_group, delivery_location, quantity, delivered_date
    )
    SELECT full_name, email, phone_number, blood_group, delivery_location, quantity, CURDATE()
    FROM user_requests
    WHERE request_id = $id";

    if ($conn->query($insertSql) === TRUE) {
        // After successful insert, delete from user_requests
        $deleteSql = "DELETE FROM user_requests WHERE request_id = $id";
        $conn->query($deleteSql);
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }

} elseif ($action === 'Delete') {
    // Directly delete from user_requests
    $deleteSql = "DELETE FROM user_requests WHERE request_id = $id";
    if ($conn->query($deleteSql) === TRUE) {
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}

$conn->close();
?>
