<?php
session_start();
include 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alumni_id = intval($_POST['alumni_id']);
    $membership_type = trim($_POST['membership_type']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Insert into database
    $query = "INSERT INTO Membership (Alumni_ID, Membership_Type, Start_Date, End_Date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $alumni_id, $membership_type, $start_date, $end_date);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Membership added successfully!";
    } else {
        $_SESSION['message'] = "Failed to add membership.";
    }

    $stmt->close();
    $conn->close();

    header("Location: membership.php");
    exit();
}
?>
