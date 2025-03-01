


<?php
session_start(); // Start the session to access session variables

include './database/connection.php';

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ensure user_id is set from the session
if (!isset($_SESSION['user_id'])) {
    die("User not logged in."); // Handle the case when the user is not logged in
}

if (isset($_POST['btn_submit'])) {
    $user_id = $_SESSION['user_id']; // Get the user ID from the session
    $user_message = $_POST["message"];
    $user_message = mysqli_real_escape_string($con, $user_message);

    // Insert the user message with user_id into the contacts table
    $sql = "INSERT INTO `contacts`(`user_id`, `users_messages`) VALUES ('$user_id', '$user_message')";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Message submitted successfully!')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="cssdesign/style4.css">
    <link rel="stylesheet" href="cssdesign/font.css">
    <style>
        .notification-box {
            display: none; /* Initially hidden */
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <nav>
        <ul class="nav-menu">
            <li><a href="index.php">HOME</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="gallery.php">GALLERY</a></li>
            <li><a href="contact.php">CONTACT</a></li>
            <li>
                <a href="?showNotification=<?php echo isset($_GET['showNotification']) && $_GET['showNotification'] == 'true' ? 'false' : 'true'; ?>">
                    MESSAGE
                </a>
            </li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </nav>

    <section class="contact-section">
        <div class="contact-container">
            <br>
            <h1>Contact us today to start the creative journey!</h1><br>
            <p>Please fill out the form below, and I'll get back
               to you within 24-48 hours to discuss your project. We'll also send you an
               email confirmation with all the details. Let's bring your ideas to life! <br>
            .</p>
            
            <form action="contact.php" method="POST">
                <center> <textarea name="message" placeholder="Message:" rows="6" required></textarea> </center>  
                <center> <button type="submit" name="btn_submit">SUBMIT</button> </center>
            </form>
        </div>
    </section>
    
    <!-- Include Notification Box -->
    <?php if (isset($_GET['showNotification']) && $_GET['showNotification'] == 'true'): ?>
        <?php include 'notification-box.php'; ?>
        <script>
            document.getElementById('notification-box').style.display = 'block';
        </script>
    <?php else: ?>
        <script>
            document.getElementById('notification-box').style.display = 'none';
        </script>
    <?php endif; ?>
</body>
</html>
