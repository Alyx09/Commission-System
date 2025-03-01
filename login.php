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

// Start the session
session_start();

// Check if the form is submitted
if (isset($_POST['btn_login'])) {
    $user_name = $_POST['username'];
    $user_password = $_POST['password'];

    // SQL query to check if the user exists
    $sql = "SELECT * FROM `user_account` WHERE `user_name` = '$user_name' AND `user_password` = '$user_password'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // User found, login successful
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['user_name']; // Store username in session
        $_SESSION['user_id'] = $row['user_id']; // Store user ID in session for role checking

        // Check if the user is admin (user_id = 1)
        if ($row['user_id'] == 1) {
            // Redirect to admin dashboard
            header("Location: adminpage/index.php?login=success");
            exit;
        } else {
            // Redirect to user page
            header("Location: userspage/index.php?login=success");
            exit;
        }
    } else {
        // Account not found, login failed
        header("Location: login.php?error=invalid");
        exit;
    }
}

// Check for login error message
if (isset($_GET['error']) && $_GET['error'] === 'invalid') {
    echo "<script>alert('Invalid username or password. Please try again.');</script>";
} elseif (isset($_GET['error']) && $_GET['error'] === 'not_authorized') {
    echo "<script>alert('You are not authorized to access this page.');</script>";
} elseif (isset($_GET['error']) && $_GET['error'] === 'not_logged_in') {
    echo "<script>alert('Please log in first.');</script>";
}
?>

<div class="logo-container">
    <img src="cssdesign/logo.png" alt="Logo" class="logo">
</div>
<div class="login-container">
    <div class="login-box">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="input-group">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="login-button" name="btn_login">Login</button>
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </div>
</div>
</body>
</html>
s