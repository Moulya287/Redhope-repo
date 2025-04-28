<?php
$host = "localhost";
$username = "root";
$password = "mouman321";
$database = "red_hope_blood_bank"; // Corrected DB name

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $user = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $pass = trim(mysqli_real_escape_string($conn, $_POST['password']));

    // Check if inputs are not empty
    if (empty($user) || empty($email) || empty($pass)) {
        echo "<h3 style='color:red; text-align:center; margin-top:20px;'>All fields are required.</h3>";
        exit();
    }

    // SQL Query
    $query = "SELECT * FROM admin WHERE username='$user' AND email='$email' AND password='$pass'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login success
        header("Location: AdHome.html"); // Redirect to Admin Home
        exit();
    } else {
        // Login fail
        echo "<h3 style='color:red; text-align:center; margin-top:20px;'>Invalid credentials. Please try again.</h3>";
    }
}

mysqli_close($conn);
?>
