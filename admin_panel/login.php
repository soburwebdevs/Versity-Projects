<?php
session_start();
include('db.php');

$error = '';  // Initialize the error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if admin exists
    $sql = "SELECT * FROM admin WHERE a_email='$email' AND a_password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Admin found, fetch their details
        $admin = $result->fetch_assoc();

        // Store admin details in session
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_first_name'] = $admin['a_first_name'];  // Store first name
        $_SESSION['admin_id'] = $admin['a_id'];  // Store admin ID or any other info

        // Redirect to the dashboard
        header("Location: index.php");  // Redirecting to the admin home page
        exit();
    } else {
        // If invalid login details, set error message
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            text-align: center;
            width: 350px;
        }
        h2 {
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background: #333;
            color: white;
            font-size: 16px;
        }
        input:focus {
            outline: none;
            background: #444;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Admin Login</h2>
    
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="post">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
