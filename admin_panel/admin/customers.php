<?php
include('../db.php'); // Include the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers List</title>
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
        .action-btn {
            background-color: #444;
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            margin: 0 5px;
        }
        .action-btn:hover {
            background-color: #666;
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
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }
        .add-btn:hover {
            background-color: #005f75;
        }
    </style>
</head>
<body>

    <h2>Customers List</h2>

    <!-- Add Customer Button -->
    <a href="add_customer.php" class="add-btn">+ Add Customer</a>

    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Street</th>
            <th>Actions</th>
        </tr>

        <?php
        // Fetch all customers except passwords
        $sql = "SELECT c_id, c_first_name, c_last_name, c_phone, c_email, c_street FROM customer";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["c_id"] . "</td>
                        <td>" . $row["c_first_name"] . "</td>
                        <td>" . $row["c_last_name"] . "</td>
                        <td>" . $row["c_phone"] . "</td>
                        <td>" . $row["c_email"] . "</td>
                        <td>" . $row["c_street"] . "</td>
                        <td>
                            <a href='edit_customer.php?id=" . $row["c_id"] . "' class='action-btn'>Edit</a>
                            <a href='delete_customer.php?id=" . $row["c_id"] . "' class='action-btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this customer?\");'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No customers found</td></tr>";
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
