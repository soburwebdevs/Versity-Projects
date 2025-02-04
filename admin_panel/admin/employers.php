<?php
include('../db.php'); // Include the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employers List</title>
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

    <h2>Employers List</h2>

    <!-- Add Employer Button -->
    <a href="add_employers.php" class="add-btn">+ Add Employer</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Position</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>

        <?php
        // Fetch all employers except passwords
        $sql = "SELECT e_id, e_name, e_phone, e_email, e_position, e_address FROM employee";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["e_id"] . "</td>
                        <td>" . $row["e_name"] . "</td>
                        <td>" . $row["e_phone"] . "</td>
                        <td>" . $row["e_email"] . "</td>
                        <td>" . $row["e_position"] . "</td>
                        <td>" . $row["e_address"] . "</td>
                        <td>
                            <a href='edit_employer.php?id=" . $row["e_id"] . "' class='action-btn'>Edit</a>
                            <a href='delete_employer.php?id=" . $row["e_id"] . "' class='action-btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this employer?\");'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No employers found</td></tr>";
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
