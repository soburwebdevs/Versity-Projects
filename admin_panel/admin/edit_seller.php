<?php
include('../db.php'); // Include the database connection

if (isset($_GET['id'])) {
    $s_id = $_GET['id'];

    // Fetch existing seller data
    $sql = "SELECT * FROM seller WHERE s_id = $s_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $seller = $result->fetch_assoc();
    } else {
        echo "<script>alert('Seller not found!'); window.location='sellers.php';</script>";
        exit;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_name = $_POST['s_name'];
    $s_phone = $_POST['s_phone'];
    $s_email = $_POST['s_email'];
    $s_address = $_POST['s_address'];
    $s_bank_account_no = $_POST['s_bank_account_no'];

    // Check if password is updated
    if (!empty($_POST['s_password'])) {
        $s_password = password_hash($_POST['s_password'], PASSWORD_BCRYPT);
        $sql = "UPDATE seller SET s_name='$s_name', s_phone='$s_phone', s_email='$s_email', 
                s_address='$s_address', s_bank_account_no='$s_bank_account_no', s_password='$s_password'
                WHERE s_id = $s_id";
    } else {
        $sql = "UPDATE seller SET s_name='$s_name', s_phone='$s_phone', s_email='$s_email', 
                s_address='$s_address', s_bank_account_no='$s_bank_account_no' 
                WHERE s_id = $s_id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Seller updated successfully!'); window.location='sellers.php';</script>";
    } else {
        echo "Error updating seller: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Seller</title>
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
            background-color: #ff9800;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .submit-btn:hover {
            background-color: #e68900;
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

    <h2>Edit Seller</h2>
    <form action="" method="POST">
        <input type="text" name="s_name" value="<?php echo $seller['s_name']; ?>" required>
        <input type="text" name="s_phone" value="<?php echo $seller['s_phone']; ?>" required>
        <input type="email" name="s_email" value="<?php echo $seller['s_email']; ?>" required>
        <input type="text" name="s_address" value="<?php echo $seller['s_address']; ?>" required>
        <input type="text" name="s_bank_account_no" value="<?php echo $seller['s_bank_account_no']; ?>" required>
        <input type="password" name="s_password" placeholder="New Password (leave blank to keep old)">
        <br>
        <button type="submit" class="submit-btn">Update Seller</button>
    </form>

    <br>
    <a href="sellers.php" class="back-btn">Back to Sellers</a>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
