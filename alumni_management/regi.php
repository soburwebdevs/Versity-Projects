<?php
include 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];  // Added Last Name
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $grad_year = $_POST['grad_year'];
    $degree = $_POST['degree'];
    $department = $_POST['department'];
    $job_title = $_POST['job_title'];
    $company = $_POST['company'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert into Alumni table
    $query = "INSERT INTO Alumni 
        (First_Name, Last_Name, Date_of_Birth, Gender, Email, Phone_Number, Address, City, State, Country, Graduation_Year, Degree, Department, Current_Job_Title, Company_Name) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssssissss", $first_name, $last_name, $dob, $gender, $email, $phone, $address, $city, $state, $country, $grad_year, $degree, $department, $job_title, $company);

    if ($stmt->execute()) {
        $alumni_id = $conn->insert_id;

        // Insert into Login table
        $login_query = "INSERT INTO Login (User_ID, Username, Password, Role) VALUES (?, ?, ?, 'Alumni')";
        $login_stmt = $conn->prepare($login_query);
        $login_stmt->bind_param("iss", $alumni_id, $username, $password);
        $login_stmt->execute();

        echo "Registration successful! <a href='login.php'>Login Here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Alumni Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .register-container {
            background-color: #fff;
            width: 100%;
            max-width: 500px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            font-size: 24px;
        }
        h3 {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 18px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="date"], input[type="number"], select {
            width: 100%;
            padding: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            margin-top: 8px;
        }
        button {
            width: 100%;
            padding: 14px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .form-group select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <h2>Register for Alumni Dashboard</h2>
        <h3>Join the network of alumni and stay connected!</h3>

        <form method="POST">
            <div class="form-group">
                <input type="text" name="first_name" placeholder="First Name" required>
            </div>
            <div class="form-group">
                <input type="text" name="last_name" placeholder="Last Name" required> <!-- Last Name field -->
            </div>
            <div class="form-group">
                <input type="date" name="dob" required>
            </div>
            <div class="form-group">
                <select name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="text" name="phone" placeholder="Phone" required>
            </div>
            <div class="form-group">
                <input type="text" name="address" placeholder="Address" required>
            </div>
            <div class="form-group">
                <input type="text" name="city" placeholder="City" required>
            </div>
            <div class="form-group">
                <input type="text" name="state" placeholder="State" required>
            </div>
            <div class="form-group">
                <input type="text" name="country" placeholder="Country" required>
            </div>
            <div class="form-group">
                <input type="number" name="grad_year" placeholder="Graduation Year" required>
            </div>
            <div class="form-group">
                <input type="text" name="degree" placeholder="Degree" required>
            </div>
            <div class="form-group">
                <input type="text" name="department" placeholder="Department" required>
            </div>
            <div class="form-group">
                <input type="text" name="job_title" placeholder="Job Title">
            </div>
            <div class="form-group">
                <input type="text" name="company" placeholder="Company">
            </div>
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Register</button>
        </form>

        <div class="login-link">
            <p>Already have an account? <a href="login.php">Login Here</a></p>
        </div>
    </div>

</body>
</html>
