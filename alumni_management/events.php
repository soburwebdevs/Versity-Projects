<?php
session_start();
include 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all events
$query = "SELECT * FROM Events ORDER BY Event_Date DESC";
$result = $conn->query($query);

// Check if the user is an admin (for delete access)
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Events</title>
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
        .events-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .events-box h1 {
            font-size: 28px;
            color: #007bff;
            text-align: center;
        }
        .event {
            background: #e9f5ff;
            padding: 15px;
            margin-top: 15px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        .event h2 {
            color: #0056b3;
        }
        .event p {
            font-size: 16px;
            color: #333;
        }
        .delete-btn {
            background-color: #ff4c4c;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background 0.3s;
        }
        .delete-btn:hover {
            background-color: #d03939;
        }
        .add-event-form {
            margin-top: 30px;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 10px;
        }
        .add-event-form input, .add-event-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .add-event-form button {
            margin-top: 10px;
            padding: 10px;
            width: 100%;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .add-event-form button:hover {
            background-color: #218838;
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
        <div class="events-box">
            <h1>Upcoming Events</h1>

            <?php while ($event = $result->fetch_assoc()): ?>
                <div class="event">
                    <h2><?php echo htmlspecialchars($event['Event_Name']); ?></h2>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($event['Event_Date']); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($event['Location']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($event['Description']); ?></p>
                    <p><strong>Organizer:</strong> <?php echo htmlspecialchars($event['Organizer_Name']); ?></p>
                    
                    <?php if ($isAdmin): ?>
                        <form action="delete_event.php" method="POST" style="display:inline;">
                            <input type="hidden" name="event_id" value="<?php echo $event['Event_ID']; ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>

            <!-- Add Event Form -->
            <div class="add-event-form">
                <h2>Add New Event</h2>
                <form action="add_event.php" method="POST">
                    <input type="text" name="event_name" placeholder="Event Name" required>
                    <input type="date" name="event_date" required>
                    <input type="text" name="location" placeholder="Location" required>
                    <textarea name="description" placeholder="Description" required></textarea>
                    <input type="text" name="organizer_name" placeholder="Organizer Name" required>
                    <button type="submit">Add Event</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
