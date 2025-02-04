<?php
session_start();
include 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch existing memberships
$query = "SELECT Membership.Membership_ID, Alumni.First_Name, Alumni.Last_Name, Membership.Membership_Type, Membership.Start_Date, Membership.End_Date 
          FROM Membership 
          JOIN Alumni ON Membership.Alumni_ID = Alumni.Alumni_ID
          ORDER BY Membership.Start_Date DESC";
$result = $conn->query($query);

// Fetch all alumni for dropdown
$alumniQuery = "SELECT Alumni_ID, First_Name, Last_Name FROM Alumni";
$alumniResult = $conn->query($alumniQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f6f9;
        }
        .sidebar {
            width: 250px;
            background-color: #007bff;
            color: white;
            padding-top: 20px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            font-size: 18px;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: #0056b3;
        }
        .content {
            margin-left: 250px;
            padding: 30px;
            flex: 1;
        }
        .memberships-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .memberships-box h1 {
            font-size: 28px;
            color: #007bff;
            text-align: center;
        }
        .membership {
            background: #e9f5ff;
            padding: 15px;
            margin-top: 15px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        .membership h2 {
            color: #0056b3;
        }
        .membership p {
            font-size: 16px;
            color: #333;
        }
        .add-membership-form {
            margin-top: 30px;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 10px;
        }
        .add-membership-form select, .add-membership-form input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .add-membership-form button {
            margin-top: 10px;
            padding: 10px;
            width: 100%;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .add-membership-form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Alumni Dashboard</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="profile.php">Alumni Profile</a>
        <a href="events.php">Events</a>
        <a href="membership.php">Membership</a>
        <a href="donation.php">Donation</a>
        <a href="feedback.php">Feedback</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="memberships-box">
            <h1>Alumni Memberships</h1>

            <?php while ($membership = $result->fetch_assoc()): ?>
                <div class="membership">
                    <h2><?php echo htmlspecialchars($membership['First_Name'] . " " . $membership['Last_Name']); ?></h2>
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($membership['Membership_Type']); ?></p>
                    <p><strong>Start Date:</strong> <?php echo htmlspecialchars($membership['Start_Date']); ?></p>
                    <p><strong>End Date:</strong> <?php echo htmlspecialchars($membership['End_Date']); ?></p>
                </div>
            <?php endwhile; ?>

            <!-- Add Membership Form -->
            <div class="add-membership-form">
                <h2>Add New Membership</h2>
                <form action="add_membership.php" method="POST">
                    <label for="alumni">Select Alumni:</label>
                    <select name="alumni_id" required>
                        <option value="">-- Select Alumni --</option>
                        <?php while ($alumni = $alumniResult->fetch_assoc()): ?>
                            <option value="<?php echo $alumni['Alumni_ID']; ?>">
                                <?php echo htmlspecialchars($alumni['First_Name'] . " " . $alumni['Last_Name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <label for="membership_type">Membership Type:</label>
                    <input type="text" name="membership_type" placeholder="Gold, Silver, etc." required>
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" required>
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" required>
                    <button type="submit">Add Membership</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
