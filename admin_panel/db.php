<?php
$servername = "localhost";  // Server name
$username = "root";         // Your database username (usually "root")
$password = "";             // Your database password (default is empty for XAMPP)
$dbname = "user";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
