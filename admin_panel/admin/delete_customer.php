<?php
include('../db.php'); // Include the database connection

// Check if an ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$c_id = $_GET['id'];

// Delete customer from the database
$sql = "DELETE FROM customer WHERE c_id = '$c_id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Customer deleted successfully!');
            window.location.href = 'customers.php';
          </script>";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
