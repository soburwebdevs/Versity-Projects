<?php 
include("includes/header.php"); 
include("includes/sidebar.php"); 

session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Logout logic
if (isset($_POST['logout'])) {
    session_destroy();  // Destroy session
    header("Location: login.php");  // Redirect to login page
    exit();
}

// Get the admin's first name from the session
$admin_first_name = $_SESSION['admin_first_name'];
?>

<div class="main-content">
    <h1>Welcome Admin, <?php echo htmlspecialchars($admin_first_name); ?></h1>
    <!-- <p>This is the dashboard. Manage admins, employers, and customers here.</p> -->
</div>

<!-- Logout Button in Top-right corner -->
<form method="POST" style="position: absolute; top: 20px; right: 20px;">
    <button type="submit" name="logout" class="logout-button">Logout</button>
</form>

<?php include("includes/footer.php"); ?>

