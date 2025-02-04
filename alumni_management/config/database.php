<?php
// Database Configuration
$DB_HOST = 'localhost';   
$DB_USER = 'root';        
$DB_PASS = '';            
$DB_NAME = 'alumni_management';   

// Create MySQL Connection
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Check Connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
