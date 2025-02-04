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
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $graduation_year = $_POST['graduation_year'];
    $degree = $_POST['degree'];
    $department = $_POST['department'];
    $job_title = $_POST['job_title'];
    $company_name = $_POST['company_name'];

    // Update alumni details
    $update_query = "UPDATE Alumni SET First_Name=?, Last_Name=?, Email=?, Phone_Number=?, Address=?, Graduation_Year=?, Degree=?, Department=?, Current_Job_Title=?, Company_Name=? WHERE Alumni_ID=?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssssssssi", $first_name, $last_name, $email, $phone, $address, $graduation_year, $degree, $department, $job_title, $company_name, $user_id);
    
    if ($stmt->execute()) {
        header("Location: profile.php"); // Redirect to profile page after update
        exit();
    } else {
        echo "Error updating profile!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alumni Profile</title>
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
        .edit-profile-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        .edit-profile-box h1 {
            font-size: 28px;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .save-btn {
            width: 100%;
            background-color: #28a745;
            color: white;
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .save-btn:hover {
            background-color: #218838;
        }
        .cancel-btn {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
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
        <div class="edit-profile-box">
            <h1>Edit Profile</h1>
            <form method="post">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['First_Name']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['Last_Name']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($user['Phone_Number']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($user['Address']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Graduation Year</label>
                    <input type="text" name="graduation_year" value="<?php echo htmlspecialchars($user['Graduation_Year']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Degree</label>
                    <input type="text" name="degree" value="<?php echo htmlspecialchars($user['Degree']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Department</label>
                    <input type="text" name="department" value="<?php echo htmlspecialchars($user['Department']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Current Job Title</label>
                    <input type="text" name="job_title" value="<?php echo htmlspecialchars($user['Current_Job_Title']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" name="company_name" value="<?php echo htmlspecialchars($user['Company_Name']); ?>" required>
                </div>
                <button type="submit" class="save-btn">Save Changes</button>
            </form>
            <a href="profile.php" class="cancel-btn">Cancel</a>
        </div>
    </div>

</body>
</html>
