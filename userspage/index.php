<?php
session_start(); // Start the session

// Check if the user is logged in (assuming user_id is set in session on successful login)
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to index.php
    header('Location: ../index.php'); // Adjust the path if needed
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jols.Luominen</title>
    <link rel="stylesheet" href="cssdesign/style1.css">
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

    <div>
        <img class="image-container" src="img/waybuot.jpg" alt="cover photo">
    </div>
    <div id='rectangle6' class='rectangle6'>
        <img id='image1' class='image1' src='img/Final.jpg'>
        <div id='whatisjolsluominen?' class='text1'> What is Jols Luominen? </div>
        <div id='jolse' class='text2'>
            Jols Luominen is a comprehensive digital art commission platform designed to streamline the process of 
            accepting and managing custom artwork requests. Tailored for a single dedicated artist, this platform 
            enables seamless communication with clients from around the world, ensuring that each commission is 
            handled efficiently and with personal attention.
        </div>
        <div class='rectangle7'>
            <nav>
                <a href="about.php" class="nav-button">VISIT ABOUT</a> 
            </nav>
            <div id='rectangle8' class='rectangle8'>
                <a href="gallery.php" class="nav-button2">VISIT MY GALLERY</a>
            </div>

            <div class="cards">
                <div class="card"><a href="image-modal.php?image=art1.jpg&title=DECEIT & date=February 7th 2024"><img src="img/art1.jpg" alt="Card 1"></a></div>
                <div class="card"><a href="image-modal.php?image=art2.png&title=SCARLXRD & date=January 25th 2024"><img src="img/art2.png" alt="Card 2"></a></div>
                <div class="card"><img src="img/art3.jpg" alt="Card 3"></div>
            </div>

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

            <footer>
                © Copyright <strong>Jolsluominen</strong>. All Rights Reserved
                Design / Web Made by: <strong>Shandy Pacana</strong>
            </footer>
        </div>
    </div>
    
</body>
</html>
