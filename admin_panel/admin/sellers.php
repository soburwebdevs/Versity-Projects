<?php
include('../db.php'); // Include the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sellers List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: white;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #333;
        }
        th, td {
            border: 1px solid #555;
            padding: 10px;
        }
        th {
            background-color: #444;
        }
        tr:hover {
            background-color: #555;
        }
        .back-btn, .action-btn, .add-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }
        .back-btn {
            background-color: #444;
            color: white;
        }
        .back-btn:hover {
            background-color: #666;
        }
        .action-btn {
            background-color: #008CBA;
            color: white;
        }
        .action-btn:hover {
            background-color: #005f75;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .delete-btn:hover {
            background-color: #d32f2f;
        }
        .add-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
        }
        .add-btn:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>

    <h2>Sellers List</h2>

    <!-- Add Seller Button -->
    <a href="add_seller.php" class="add-btn">+ Add Seller</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>

        <?php
        // Fetch all sellers (excluding passwords)
        $sql = "SELECT s_id, s_name, s_phone, s_email, s_address FROM seller";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["s_id"] . "</td>
                        <td>" . $row["s_name"] . "</td>
                        <td>" . $row["s_phone"] . "</td>
                        <td>" . $row["s_email"] . "</td>
                        <td>" . $row["s_address"] . "</td>
                        <td>
                            <a href='edit_seller.php?id=" . $row["s_id"] . "' class='action-btn'>Edit</a>
                            <a href='delete_seller.php?id=" . $row["s_id"] . "' class='action-btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this seller?\");'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No sellers found</td></tr>";
        }
        ?>

    </table>
    <br>
    <a href="../index.php" class="back-btn">Back to Admin Panel</a>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
