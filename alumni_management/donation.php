<?php
session_start();
include 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Donation</title>
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
        .donation-box {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            margin: auto;
        }
        .donation-box h1 {
            font-size: 30px;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Donation Amount */
        .donation-amount {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        .donation-amount button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        .donation-amount button:hover {
            background-color: #0056b3;
        }
        .custom-amount {
            display: none;
            margin-top: 10px;
        }
        .custom-amount input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Payment Method */
        .payment-method {
            text-align: left;
            margin-top: 20px;
        }
        .payment-method label {
            font-size: 18px;
            margin-right: 10px;
        }
        .payment-box {
            display: none;
            margin-top: 10px;
        }
        .payment-box input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Personal Information */
        .personal-info {
            margin-top: 20px;
        }
        .personal-info input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        /* Donate Button */
        .donate-btn {
            margin-top: 20px;
            background: linear-gradient(45deg, #28a745, #218838);
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 20px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
        }
        .donate-btn:hover {
            background: linear-gradient(45deg, #218838, #1e7e34);
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
        <div class="donation-box">
            <h1>Support Your Alumni Community 💙</h1>

            <!-- Donation Amount Section -->
            <div class="donation-amount">
                <button onclick="setAmount(10)">$10</button>
                <button onclick="setAmount(25)">$25</button>
                <button onclick="setAmount(50)">$50</button>
                <button onclick="setAmount(100)">$100</button>
                <button onclick="showCustom()">Custom</button>
            </div>
            <div class="custom-amount" id="custom-amount">
                <input type="number" id="donation-value" placeholder="Enter Custom Amount">
            </div>

            <!-- Payment Method -->
            <div class="payment-method">
                <h2>Select Payment Method</h2>
                <label><input type="radio" name="payment" value="credit" onclick="togglePaymentBox('credit')"> Credit Card</label>
                <label><input type="radio" name="payment" value="paypal" onclick="togglePaymentBox('paypal')"> PayPal</label>
                <div class="payment-box" id="payment-box">
                    <input type="text" placeholder="Enter Credit Card Number">
                </div>
            </div>

            <!-- Personal Information -->
            <div class="personal-info">
                <h2>Personal Information</h2>
                <input type="text" placeholder="First Name">
                <input type="text" placeholder="Last Name">
                <input type="email" placeholder="Email Address">
            </div>

            <!-- Donate Now Button -->
            <button class="donate-btn">Donate Now</button>
        </div>
    </div>

    <script>
        function setAmount(value) {
            document.getElementById("donation-value").value = value;
            document.getElementById("custom-amount").style.display = "none";
        }
        function showCustom() {
            document.getElementById("custom-amount").style.display = "block";
        }
        function togglePaymentBox(method) {
            if (method === "credit") {
                document.getElementById("payment-box").style.display = "block";
            } else {
                document.getElementById("payment-box").style.display = "none";
            }
        }
    </script>

</body>
</html>
