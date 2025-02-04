<?php
include('../db.php'); // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_name = $_POST['s_name'];
    $s_phone = $_POST['s_phone'];
    $s_email = $_POST['s_email'];
    $s_address = $_POST['s_address'];
    $s_bank_account_no = $_POST['s_bank_account_no'];
    $s_password = password_hash($_POST['s_password'], PASSWORD_BCRYPT); // Hashing password

    $sql = "INSERT INTO seller (s_name, s_phone, s_email, s_address, s_bank_account_no, s_password) 
            VALUES ('$s_name', '$s_phone', '$s_email', '$s_address', '$s_bank_account_no', '$s_password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New seller added successfully!'); window.location='sellers.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Seller</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: white;
            text-align: center;
        }
        form {
            width: 50%;
            margin: auto;
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        .submit-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .submit-btn:hover {
            background-color: #1e7e34;
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
        }
        .back-btn:hover {
            background-color: #666;
        }
    </style>
</head>
<body>

    <h2>Add Seller</h2>
    <form action="" method="POST">
        <input type="text" name="s_name" placeholder="Seller Name" required>
        <input type="text" name="s_phone" placeholder="Phone Number" required>
        <input type="email" name="s_email" placeholder="Email" required>
        <input type="text" name="s_address" placeholder="Address" required>
        <input type="text" name="s_bank_account_no" placeholder="Bank Account Number" required>
        <input type="password" name="s_password" placeholder="Password" required>
        <br>
        <button type="submit" class="submit-btn">Add Seller</button>
    </form>

    <br>
    <a href="sellers.php" class="back-btn">Back to Sellers</a>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
