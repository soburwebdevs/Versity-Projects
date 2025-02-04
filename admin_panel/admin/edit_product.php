<?php
include('../db.php'); // Include database connection

// Check if p_id is provided in URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid Product ID!'); window.location='products.php';</script>";
    exit();
}

$p_id = $_GET['id'];

// Fetch product details
$productQuery = "SELECT * FROM product WHERE pr_id = '$p_id'";
$productResult = $conn->query($productQuery);

if ($productResult->num_rows == 0) {
    echo "<script>alert('Product not found!'); window.location='products.php';</script>";
    exit();
}

$product = $productResult->fetch_assoc();

// Fetch all sellers for the dropdown
$sellerQuery = "SELECT s_id, s_name FROM seller";
$sellerResult = $conn->query($sellerQuery);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_id = $_POST["s_id"];
    $p_name = $_POST["p_name"];
    $p_price = $_POST["p_price"];
    $p_category = $_POST["p_category"];
    $p_model = $_POST["p_model"];

    // Update product in database
    $updateQuery = "UPDATE product SET 
                    s_id = '$s_id', 
                    p_name = '$p_name', 
                    p_price = '$p_price', 
                    p_category = '$p_category', 
                    p_model = '$p_model' 
                    WHERE pr_id = '$p_id'";

    if ($conn->query($updateQuery) === TRUE) {
        echo "<script>alert('Product updated successfully!'); window.location='products.php';</script>";
    } else {
        echo "Error: " . $updateQuery . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: white;
            text-align: center;
        }
        form {
            width: 40%;
            margin: auto;
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
        }
        label, input, select {
            display: block;
            margin: 10px auto;
            width: 90%;
        }
        input, select {
            padding: 8px;
            border: 1px solid #555;
            border-radius: 5px;
        }
        .submit-btn {
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .submit-btn:hover {
            background-color: #005f75;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #444;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }
        .back-btn:hover {
            background-color: #666;
        }
    </style>
</head>
<body>

    <h2>Edit Product</h2>

    <form method="POST">
        <label for="s_id">Select Seller:</label>
        <select name="s_id" required>
            <?php
            if ($sellerResult->num_rows > 0) {
                while ($seller = $sellerResult->fetch_assoc()) {
                    $selected = ($seller["s_id"] == $product["s_id"]) ? "selected" : "";
                    echo "<option value='" . $seller["s_id"] . "' $selected>" . $seller["s_id"] . " - " . $seller["s_name"] . "</option>";
                }
            }
            ?>
        </select>

        <label for="p_name">Product Name:</label>
        <input type="text" name="p_name" value="<?php echo $product['p_name']; ?>" required>

        <label for="p_price">Product Price ($):</label>
        <input type="number" step="0.01" name="p_price" value="<?php echo $product['p_price']; ?>" required>

        <label for="p_category">Category:</label>
        <input type="text" name="p_category" value="<?php echo $product['p_category']; ?>" required>

        <label for="p_model">Model:</label>
        <input type="text" name="p_model" value="<?php echo $product['p_model']; ?>" required>

        <button type="submit" class="submit-btn">Update Product</button>
    </form>

    <br>
    <a href="products.php" class="back-btn">Back to Products</a>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
