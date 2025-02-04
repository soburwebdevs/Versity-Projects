<?php
session_start();
include 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch alumni details
$query = "SELECT * FROM Alumni WHERE Alumni_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "No user found!";
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Profile</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .profile-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 60%;
        }
        .profile-box h1 {
            font-size: 28px;
            color: #007bff;
            text-align: center;
        }
        .profile-details {
            margin-top: 20px;
        }
        .profile-details p {
            font-size: 18px;
            color: #333;
            margin-bottom: 12px;
        }
        .profile-details strong {
            color: #0056b3;
        }
        .edit-profile-btn {
            display: block;
            width: 200px;
            margin: 30px auto 0;
            text-align: center;
            padding: 12px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            font-size: 18px;
            border-radius: 6px;
            transition: transform 0.2s, background-color 0.3s;
        }
        .edit-profile-btn:hover {
            background-color: #218838;
            transform: scale(1.05);
        }
        .avatar-container {
            width: 30%;
            display: flex;
            justify-content: center;
        }
        .avatar {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-image: url('images/alumni_avatar.jpg');
            background-size: cover;
            background-position: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .logout-btn {
            display: block;
            background-color: #ff4c4c;
            color: white;
            text-align: center;
            padding: 12px;
            margin-top: 20px;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.3s;
        }
        .logout-btn:hover {
            background-color: #d03939;
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
        <div class="profile-box">
            <h1>Alumni Profile</h1>
            <div class="profile-details">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($user['First_Name'] . " " . $user['Last_Name']); ?></p>
                <!-- <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['Date_Of_Birth']); ?></p> -->
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['Gender']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['Phone_Number']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($user['Address'] . ", " . $user['City'] . ", " . $user['State'] . ", " . $user['Country']); ?></p>
                <p><strong>Graduation Year:</strong> <?php echo htmlspecialchars($user['Graduation_Year']); ?></p>
                <p><strong>Degree:</strong> <?php echo htmlspecialchars($user['Degree']); ?></p>
                <p><strong>Department:</strong> <?php echo htmlspecialchars($user['Department']); ?></p>
                <p><strong>Current Job:</strong> <?php echo htmlspecialchars($user['Current_Job_Title']); ?> at <?php echo htmlspecialchars($user['Company_Name']); ?></p>
            </div>

            <!-- Edit Profile Button -->
            <a href="edit_profile.php" class="edit-profile-btn">Edit Profile</a>
        </div>

        <!-- Profile Avatar (Right Side) -->
        <div class="avatar-container">
            <div class="avatar"></div>
        </div>
    </div>

</body>
</html>
