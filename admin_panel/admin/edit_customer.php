<?php
include('../db.php'); // Include the database connection

// Check if an ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$c_id = $_GET['id'];

// Fetch customer details based on ID
$sql = "SELECT * FROM customer WHERE c_id = '$c_id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Customer not found.");
}

$row = $result->fetch_assoc();

// Initialize variables with existing data
$c_first_name = $row['c_first_name'];
$c_last_name = $row['c_last_name'];
$c_phone = $row['c_phone'];
$c_email = $row['c_email'];
$c_street = $row['c_street'];
$error_message = $success_message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $c_first_name = $_POST['c_first_name'];
    $c_last_name = $_POST['c_last_name'];
    $c_phone = $_POST['c_phone'];
    $c_email = $_POST['c_email'];
    $c_street = $_POST['c_street'];

    // Validate input
    if (empty($c_first_name) || empty($c_last_name) || empty($c_phone) || empty($c_email) || empty($c_street)) {
        $error_message = "All fields are required.";
    } else {
        // Update the customer data
        $update_sql = "UPDATE customer SET 
            c_first_name='$c_first_name', 
            c_last_name='$c_last_name', 
            c_phone='$c_phone', 
            c_email='$c_email', 
            c_street='$c_street'
            WHERE c_id='$c_id'";

        if ($conn->query($update_sql) === TRUE) {
            $success_message = "Customer details updated successfully!";
        } else {
            $error_message = "Error updating record: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: white;
            text-align: center;
        }
        form {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            width: 60%;
            margin: auto;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #555;
            border-radius: 5px;
            background-color: #444;
            color: white;
        }
        .submit-btn {
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .submit-btn:hover {
            background-color: #005f75;
        }
        .back-btn {
            display: inline-block;
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
        .error-message, .success-message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
        }
        .error-message {
            background-color: #f44336;
            color: white;
        }
        .success-message {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

    <h2>Edit Customer</h2>

    <!-- Display error or success message -->
    <?php if ($error_message): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
    
    <?php if ($success_message): ?>
        <div class="success-message"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="c_first_name" value="<?php echo $c_first_name; ?>" required>
        <input type="text" name="c_last_name" value="<?php echo $c_last_name; ?>" required>
        <input type="text" name="c_phone" value="<?php echo $c_phone; ?>" required>
        <input type="email" name="c_email" value="<?php echo $c_email; ?>" required>
        <input type="text" name="c_street" value="<?php echo $c_street; ?>" required>
        <button type="submit" class="submit-btn">Update Customer</button>
    </form>

    <br>
    <a href="customers.php" class="back-btn">Back to Customers List</a>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
