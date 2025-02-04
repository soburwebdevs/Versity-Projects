<?php
session_start();
include('../db.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$message = ""; // Message for success or error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Basic validation: Check if fields are empty
    if (empty($first_name) || empty($last_name) || empty($phone) || empty($email) || empty($password)) {
        $message = "<p class='error'>All fields are required.</p>";
    } else {
        // Check if email already exists
        $check_email = "SELECT * FROM admin WHERE a_email = '$email'";
        $result = $conn->query($check_email);

        if ($result->num_rows > 0) {
            $message = "<p class='error'>This email is already registered!</p>";
        } else {
            // Insert new admin into the database
            $sql = "INSERT INTO admin (a_first_name, a_last_name, a_phone, a_email, a_password) 
                    VALUES ('$first_name', '$last_name', '$phone', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                $message = "<p class='success'>Admin added successfully!</p>";
                header("refresh:2;url=admins.php"); // Redirect after 2 seconds
            } else {
                $message = "<p class='error'>Error: " . $conn->error . "</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: white;
            text-align: center;
        }
        .container {
            width: 40%;
            margin: auto;
            padding: 20px;
            background-color: #333;
            border-radius: 8px;
            margin-top: 50px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border-radius: 5px;
            border: none;
        }
        button {
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
        }
        button:hover {
            background-color: #005f75;
        }
        .back-btn {
            display: block;
            margin: 20px auto;
            background-color: #444;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            width: fit-content;
        }
        .back-btn:hover {
            background-color: #666;
        }
        .success {
            color: #4CAF50;
        }
        .error {
            color: #f44336;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Add New Admin</h2>

        <?php echo $message; ?> <!-- Success/Error Message -->

        <form method="POST">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="text" name="phone" placeholder="Phone" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Add Admin</button>
        </form>

        <a href="admins.php" class="back-btn">Back to Admins</a>

    </div>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
