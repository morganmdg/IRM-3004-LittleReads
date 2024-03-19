<?php
// this is temporary until the login php can be used instead of this one
// Database connection
$servername = "localhost";
$username = "pma";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have a table named 'users' and the username is stored in a column named 'username'
$sql = "SELECT username FROM login WHERE user_id = 1"; // Adjust the WHERE clause based on your user identification method
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["username"];
    echo $username;
} else {
    echo "Guest"; // Default username if no user is logged in
}

$conn->close();
?>
