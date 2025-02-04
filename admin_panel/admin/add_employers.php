<?php
include('../db.php'); // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form inputs
    $e_name = mysqli_real_escape_string($conn, $_POST['e_name']);
    $e_phone = mysqli_real_escape_string($conn, $_POST['e_phone']);
    $e_email = mysqli_real_escape_string($conn, $_POST['e_email']);
    $e_password = mysqli_real_escape_string($conn, $_POST['e_password']);
    $e_position = mysqli_real_escape_string($conn, $_POST['e_position']);
    $e_address = mysqli_real_escape_string($conn, $_POST['e_address']);

    // Insert new employer into the database
    $sql = "INSERT INTO employee (e_name, e_phone, e_email, e_password, e_position, e_address) 
            VALUES ('$e_name', '$e_phone', '$e_email', '$e_password', '$e_position', '$e_address')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Employer added successfully!'); window.location.href='employers.php';</script>";
    } else {
        echo "<script>alert('Error adding employer: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employer</title>
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

    <h2>Add New Employer</h2>

    <div class="form-container">
        <form method="POST" action="">
            <label for="e_name">Name:</label>
            <input type="text" id="e_name" name="e_name" required>

            <label for="e_phone">Phone:</label>
            <input type="text" id="e_phone" name="e_phone" required>

            <label for="e_email">Email:</label>
            <input type="email" id="e_email" name="e_email" required>

            <label for="e_password">Password:</label>
            <input type="password" id="e_password" name="e_password" required>

            <label for="e_position">Position:</label>
            <input type="text" id="e_position" name="e_position" required>

            <label for="e_address">Address:</label>
            <input type="text" id="e_address" name="e_address" required>

            <input type="submit" value="Add Employer">
        </form>
    </div>

    <br>
    <a href="employers.php" class="back-btn">Back to Employers List</a>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
