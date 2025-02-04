<?php
session_start();
include 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$feedback_message = "";

// Handle feedback submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedback_text = trim($_POST['feedback']);
    if (!empty($feedback_text)) {
        $feedback_date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO Feedback (Alumni_ID, Feedback_Text, Feedback_Date) VALUES ('$user_id', '$feedback_text', '$feedback_date')";
        if (mysqli_query($conn, $sql)) {
            $feedback_message = "✅ Feedback submitted successfully!";
        } else {
            $feedback_message = "❌ Error: " . mysqli_error($conn);
        }
    } else {
        $feedback_message = "⚠️ Please enter your feedback!";
    }
}

// Fetch all feedback from database
$feedback_query = "SELECT Alumni.First_Name, Alumni.Last_Name, Feedback.Feedback_Text, Feedback.Feedback_Date 
                   FROM Feedback 
                   JOIN Alumni ON Feedback.Alumni_ID = Alumni.Alumni_ID 
                   ORDER BY Feedback.Feedback_Date DESC";
$feedback_result = mysqli_query($conn, $feedback_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <style>
        /* Global Styles */
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

        /* Sidebar */
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

        /* Main Content */
        .content {
            margin-left: 250px;
            padding: 40px;
            flex: 1;
        }
        .feedback-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            margin: auto;
        }
        .feedback-box h1 {
            font-size: 30px;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Feedback Form */
        .feedback-form textarea {
            width: 100%;
            height: 120px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }
        .feedback-btn {
            margin-top: 15px;
            background: linear-gradient(45deg, #28a745, #218838);
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
        }
        .feedback-btn:hover {
            background: linear-gradient(45deg, #218838, #1e7e34);
        }
        .message {
            margin-top: 10px;
            font-size: 16px;
            color: #28a745;
        }

        /* Feedback Display */
        .feedback-list {
            margin-top: 50px; /* Gap added here */
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        .feedback-item {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
        .feedback-item:last-child {
            border-bottom: none;
        }
        .feedback-item strong {
            color: #007bff;
        }
        .feedback-date {
            font-size: 12px;
            color: #777;
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
        <div class="feedback-box">
            <h1>Share Your Feedback 📝</h1>
            <form class="feedback-form" method="POST">
                <textarea name="feedback" placeholder="Write your feedback here..."></textarea>
                <button type="submit" class="feedback-btn">Submit Feedback</button>
            </form>
            <?php if (!empty($feedback_message)): ?>
                <p class="message"><?php echo $feedback_message; ?></p>
            <?php endif; ?>
        </div>
        <br><br>
        <!-- Feedback List -->
        <div class="feedback-list">
            <h2>Recent Feedbacks</h2>
            <?php while ($row = mysqli_fetch_assoc($feedback_result)): ?>
                <div class="feedback-item">
                    <strong><?php echo htmlspecialchars($row['First_Name'] . ' ' . $row['Last_Name']); ?>:</strong>
                    <p><?php echo htmlspecialchars($row['Feedback_Text']); ?></p>
                    <span class="feedback-date"><?php echo date("F j, Y, g:i a", strtotime($row['Feedback_Date'])); ?></span>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</body>
</html>
