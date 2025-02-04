<?php
session_start();
include('../db.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php");
    exit();
}

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];

    // Delete the admin from the database
    $sql = "DELETE FROM admin WHERE a_id = $admin_id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: admins.php?success=Admin deleted successfully");
        exit();
    } else {
        echo "Error deleting admin: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}
?>
