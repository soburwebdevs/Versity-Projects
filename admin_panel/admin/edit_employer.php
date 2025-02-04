<?php
include('../db.php'); // Include the database connection

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $e_id = $_GET['id'];

    // Fetch employer details from the database
    $sql = "SELECT * FROM employee WHERE e_id = '$e_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Employer not found!'); window.location.href='employers.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='employers.php';</script>";
}

// Handle form submission for updating employer
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form inputs
    $e_name = mysqli_real_escape_string($conn, $_POST['e_name']);
    $e_phone = mysqli_real_escape_string($conn, $_POST['e_phone']);
    $e_email = mysqli_real_escape_string($conn, $_POST['e_email']);
    $e_password = mysqli_real_escape_string($conn, $_POST['e_password']);
    $e_position = mysqli_real_escape_string($conn, $_POST['e_position']);
    $e_address = mysqli_real_escape_string($conn, $_POST['e_address']);

    // Update employer data in the database
    $update_sql = "UPDATE employee SET e_name='$e_name', e_phone='$e_phone', e_email='$e_email', 
                   e_password='$e_password', e_position='$e_position', e_address='$e_address' 
                   WHERE e_id='$e_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Employer updated successfully!'); window.location.href='employers.php';</script>";
    } else {
        echo "<script>alert('Error updating employer: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: white;
            text-align: center;
        }
        .form-container {
            width: 50%;
            margin: 0 auto;
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .form-container input, .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #555;
            border: none;
            border-radius: 5px;
            color: white;
        }
        .form-container input[type="submit"] {
            background-color: #008CBA;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #005f75;
        }
        .back-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #444;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }
        .back-btn:hover {
            background-color: #666;
        }
    </style>
</head>
<body>

    <h2>Edit Employer</h2>

    <div class="form-container">
        <form method="POST" action="">
            <label for="e_name">Name:</label>
            <input type="text" id="e_name" name="e_name" value="<?php echo $row['e_name']; ?>" required>

            <label for="e_phone">Phone:</label>
            <input type="text" id="e_phone" name="e_phone" value="<?php echo $row['e_phone']; ?>" required>

            <label for="e_email">Email:</label>
            <input type="email" id="e_email" name="e_email" value="<?php echo $row['e_email']; ?>" required>

            <label for="e_password">Password:</label>
            <input type="password" id="e_password" name="e_password" value="<?php echo $row['e_password']; ?>" required>

            <label for="e_position">Position:</label>
            <input type="text" id="e_position" name="e_position" value="<?php echo $row['e_position']; ?>" required>

            <label for="e_address">Address:</label>
            <input type="text" id="e_address" name="e_address" value="<?php echo $row['e_address']; ?>" required>

            <input type="submit" value="Update Employer">
        </form>
    </div>

    <br>
    <a href="employers.php" class="back-btn">Back to Employers List</a>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
