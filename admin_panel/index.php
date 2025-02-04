<?php 
include("includes/header.php"); 
include("includes/sidebar.php"); 
include("db.php"); 

session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Logout logic
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Get the admin's first name from the session
$admin_first_name = $_SESSION['admin_first_name'];

// Fetch total counts from the database
$admin_count = $conn->query("SELECT COUNT(*) AS total FROM admin")->fetch_assoc()['total'];
$employer_count = $conn->query("SELECT COUNT(*) AS total FROM employee")->fetch_assoc()['total'];
$customer_count = $conn->query("SELECT COUNT(*) AS total FROM customer")->fetch_assoc()['total'];
$seller_count = $conn->query("SELECT COUNT(*) AS total FROM seller")->fetch_assoc()['total'];
$product_count = $conn->query("SELECT COUNT(*) AS total FROM product")->fetch_assoc()['total'];

?>

<!-- DASHBOARD STARTS HERE -->
<div class="main-content">
    <h1>
        <span class="admin-name">
            Welcome Admin, <?php echo htmlspecialchars($admin_first_name); ?> 👑
        </span>
    </h1>

    <!-- Centered Container for Stats & Chart -->
    <div class="dashboard-container">
        <!-- Statistics Cards -->
        <div class="stats-container">
            <div class="stat-box admin-box">Admins: <?php echo $admin_count; ?></div>
            <div class="stat-box employer-box">Employers: <?php echo $employer_count; ?></div>
            <div class="stat-box customer-box">Customers: <?php echo $customer_count; ?></div>
            <div class="stat-box seller-box">Sellers: <?php echo $seller_count; ?></div>
            <div class="stat-box product-box">Products: <?php echo $product_count; ?></div>
        </div>

        <!-- Chart Container -->
        <canvas id="statsChart"></canvas>
    </div>
</div>

<!-- Logout Button -->
<form method="POST" class="logout-form">
    <button type="submit" name="logout" class="logout-button">Logout</button>
</form>

<!-- CSS for Logout Button -->
<style>
    .logout-form {
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .logout-button {
        background-color: #FF4C4C;  /* Red background */
        color: #FFFFFF;  /* White text */
        padding: 10px 20px;
        border: none;
        border-radius: 5px;  /* Rounded edges */
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0px 4px 8px rgba(255, 76, 76, 0.1);
    }

    .logout-button:hover {
        background-color: #D43F3F;  /* Darker red on hover */
        color: #FFF;  /* Keep text white */
        transform: scale(1.05);  /* Slight zoom effect */
        box-shadow: 0px 6px 15px rgba(255, 76, 76, 0.4);
    }
</style>



<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for Chart.js
    const data = {
        labels: ["Admins", "Employers", "Customers", "Sellers", "Products"],
        datasets: [{
            label: "Total Count",
            data: [<?php echo $admin_count; ?>, <?php echo $employer_count; ?>, <?php echo $customer_count; ?>, <?php echo $seller_count; ?>, <?php echo $product_count; ?>],
            backgroundColor: ["#FF5733", "#33FF57", "#3357FF", "#F4C724", "#A933FF"],
            borderWidth: 1
        }]
    };

    // Chart Configuration
    const config = {
        type: "bar",
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    };

    // Render Chart
    new Chart(document.getElementById("statsChart"), config);
</script>

<!-- Styling for Centered & Compact Dashboard -->
<style>
    .dashboard-container {
        max-width: 800px;  /* Smaller width */
        margin: 60px auto; /* Centered with top & bottom space */
        text-align: center;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
    }

    .stats-container {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }

    .stat-box {
        padding: 15px;
        border-radius: 8px;
        color: white;
        font-size: 16px;
        font-weight: bold;
        width: 120px; /* Smaller size */
        text-align: center;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
    }

    .admin-box { background-color: #FF5733; }
    .employer-box { background-color: #33FF57; }
    .customer-box { background-color: #3357FF; }
    .seller-box { background-color: #F4C724; }
    .product-box { background-color: #A933FF; }

    /* Chart size */
    #statsChart {
        max-width: 600px;  /* Smaller width */
        max-height: 300px; /* Smaller height */
        margin: 0 auto;
    }
</style>

<?php include("includes/footer.php"); ?>
