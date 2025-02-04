<?php
include('../db.php'); // Include database connection

// Check if p_id is provided in URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid Product ID!'); window.location='products.php';</script>";
    exit();
}

$p_id = $_GET['id'];

// Delete product from database
$deleteQuery = "DELETE FROM product WHERE pr_id = '$p_id'";

if ($conn->query($deleteQuery) === TRUE) {
    echo "<script>alert('Product deleted successfully!'); window.location='products.php';</script>";
} else {
    echo "Error deleting product: " . $conn->error;
}

$conn->close(); // Close the database connection
?>
