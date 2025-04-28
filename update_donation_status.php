<?php
$servername = "localhost";
$username = "root";
$password = "mouman321";
$dbname = "red_hope_blood_bank"; // Corrected database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_POST['id']);
$action = $_POST['action'];

if ($action === 'Approve') {
    // Insert into approved_donations
    $insertSql = "
        INSERT INTO approved_donations (
            full_name, age, gender, blood_group, contact_number,
            email, quantity, blood_donated
        )
        SELECT full_name, age, gender, blood_group, contact_number,
               email, quantity, preferred_date
        FROM user_donations
        WHERE donation_id = ?
    ";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("i", $id);
    if ($insertStmt->execute()) {
        // After successful insert, delete the original row
        $deleteSql = "DELETE FROM user_donations WHERE donation_id=?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $id);
        $deleteStmt->execute();
        $deleteStmt->close();
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
    $insertStmt->close();

} elseif ($action === 'Delete') {
    // Directly delete from user_donations
    $deleteSql = "DELETE FROM user_donations WHERE donation_id=?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $id);
    if ($deleteStmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
    $deleteStmt->close();
}

$conn->close();
?>
