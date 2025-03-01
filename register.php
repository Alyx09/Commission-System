<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jols.Luominen</title>
    <link rel="stylesheet" href="cssdesign/style.css">
</head>
<body>



<?php

include './adminpage/database/connection.php'; 

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['btn_submit'])) {
    $user_name = $_POST["username"];
    $user_password = $_POST["password"];
    $user_email = $_POST["email"];


    $sql = "INSERT INTO `user_account`(`user_name`, `user_password`, `user_email`) VALUES ('$user_name', '$user_password', '$user_email')";

    
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Account created successfully!')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

$con->close();
?>




    <div class="logo-container">
        <img src="cssdesign/logo.png" alt="Logo" class="logo">
    </div>
    <div class="login-container">
        <div class="login-box">
            <h2>Create Account</h2>
            <form action="register.php" method="POST">
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="input-group">
                    <input type="email" id="username" name="email" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="login-button" name="btn_submit">Create Acoount</button>
            </form>
            <div class="register-link">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>