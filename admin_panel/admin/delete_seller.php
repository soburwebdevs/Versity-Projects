<?php
include('../db.php'); // Include the database connection

if (isset($_GET['id'])) {
    $s_id = $_GET['id'];

    // Delete the seller from the database
    $sql = "DELETE FROM seller WHERE s_id = $s_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Seller deleted successfully!'); window.location='sellers.php';</script>";
    } else {
        echo "Error deleting seller: " . $conn->error;
    }
} else {
    echo "<script>alert('Invalid request!'); window.location='sellers.php';</script>";
}

$conn->close();
?>
