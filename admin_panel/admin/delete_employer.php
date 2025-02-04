<?php
include('../db.php'); // Include the database connection

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $e_id = $_GET['id'];

    // Delete the employer from the database
    $sql = "DELETE FROM employee WHERE e_id = '$e_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Employer deleted successfully!'); window.location.href='employers.php';</script>";
    } else {
        echo "<script>alert('Error deleting employer: " . $conn->error . "'); window.location.href='employers.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='employers.php';</script>";
}

$conn->close(); // Close the database connection
?>
