<?php
session_start();
include 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details from the Alumni table
$query = "SELECT First_Name FROM Alumni WHERE Alumni_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "No user found!";
    exit();
}

$user = $result->fetch_assoc();

// Fetch dynamic data for the chart
$alumni_count_query = "SELECT COUNT(*) AS alumni_count FROM Alumni";
$membership_count_query = "SELECT COUNT(*) AS membership_count FROM Membership";
$feedback_count_query = "SELECT COUNT(*) AS feedback_count FROM Feedback";

$alumni_result = mysqli_query($conn, $alumni_count_query);
$membership_result = mysqli_query($conn, $membership_count_query);
$feedback_result = mysqli_query($conn, $feedback_count_query);

$alumni_data = mysqli_fetch_assoc($alumni_result);
$membership_data = mysqli_fetch_assoc($membership_result);
$feedback_data = mysqli_fetch_assoc($feedback_result);

$alumni_count = $alumni_data['alumni_count'];
$membership_count = $membership_data['membership_count'];
$feedback_count = $feedback_data['feedback_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        .welcome-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .welcome-box h1 {
            font-size: 28px;
            color: #007bff;
        }
        .logout-btn {
            display: block;
            background-color: #ff4c4c;
            color: white;
            text-align: center;
            padding: 12px 20px;
            font-size: 18px;
            text-decoration: none;
            transition: background 0.3s;
            border-radius: 4px;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background-color: #d03939;
        }

        /* Chart container styling */
        .chart-container {
            width: 40%; /* Adjusted the width for medium size */
            height: 400px; /* Fixed height to ensure it fits properly */
            margin: 50px auto;
        }

        /* Stats box */
        .stats-box {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
        }
        .stats-box .stat {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 30%;
            transition: transform 0.3s ease;
        }
        .stats-box .stat:hover {
            transform: translateY(-10px);
        }
        .stat h3 {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 10px;
        }
        .stat p {
            font-size: 22px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Alumni Dashboard</h2>
        <a href="profile.php">Alumni Profile</a>
        <a href="events.php">Events</a>
        <a href="membership.php">Membership</a>
        <a href="donation.php">Donation</a>
        <a href="feedback.php">Feedback</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="welcome-box">
            <h1>Welcome, <?php echo htmlspecialchars($user['First_Name']); ?>!</h1>
        </div>

        <!-- Stats Box -->
        <div class="stats-box">
            <div class="stat">
                <h3>Total Alumni</h3>
                <p><?php echo $alumni_count; ?></p>
            </div>
            <div class="stat">
                <h3>Total Memberships</h3>
                <p><?php echo $membership_count; ?></p>
            </div>
            <div class="stat">
                <h3>Total Feedbacks</h3>
                <p><?php echo $feedback_count; ?></p>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-container">
            <canvas id="dashboardChart"></canvas>
        </div>
    </div>

    <script>
        // Chart.js code for dynamic chart
        var ctx = document.getElementById('dashboardChart').getContext('2d');
        var dashboardChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Alumni Registered', 'Memberships Taken', 'Feedbacks Given'],
                datasets: [{
                    label: 'Website Stats',
                    data: [<?php echo $alumni_count; ?>, <?php echo $membership_count; ?>, <?php echo $feedback_count; ?>],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                    borderColor: ['#0056b3', '#218838', '#e0a800'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
