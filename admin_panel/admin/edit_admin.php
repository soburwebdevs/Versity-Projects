<?php
session_start();
include('../db.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php");
    exit();
}

// Get admin ID from the URL
if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];

    // Fetch admin details
    $sql = "SELECT * FROM admin WHERE a_id = $admin_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
    } else {
        echo "Admin not found.";
        exit();
    }
}

// Handle form submission (Updating admin details)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE admin SET 
            a_first_name = '$first_name',
            a_last_name = '$last_name',
            a_phone = '$phone',
            a_email = '$email'
            WHERE a_id = $admin_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admins.php?success=Admin updated successfully");
        exit();
    } else {
        echo "Error updating admin: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: white;
            text-align: center;
        }
        .form-container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
        }
        input[type="text"], input[type="email"] {
            width: 80%;
            padding: 10px;
            margin: 10px;
            background-color: #444;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .submit-btn {
            padding: 10px 20px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #005f73;
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
    </style>
</head>
<body>

    <h2>Edit Admin</h2>
    
    <div class="form-container">
        <form method="POST">
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($admin['a_first_name']); ?>" required><br>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($admin['a_last_name']); ?>" required><br>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($admin['a_phone']); ?>" required><br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($admin['a_email']); ?>" required><br>
            <button type="submit" class="submit-btn">Update Admin</button>
        </form>
    </div>

    <a href="admins.php" class="back-btn">Back to Admins</a>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
