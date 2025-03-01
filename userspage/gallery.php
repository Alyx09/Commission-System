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
    <link rel="stylesheet" href="cssdesign/style3.css">
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
        nav {
            background-color: #111111;
            padding: 10px 0;
        }

        .nav-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        .nav-menu li {
            margin: 0 40px; 
            min-width: 100px; 
            text-align: center; /* Center the text within the item */
        }

        .nav-menu a {
            display: block; 
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 15px;
            transition: color 0.3s;
            width: 100px;
        }

        .nav-menu a:hover {
            color: #ffc400d8; /* Change color on hover */
        }

        .nav-menu a:hover {
            color: #ffc400d8; 
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

    <div id='whatisjolsluominen?' class='text3'>
     GALLERY
    </div>
    
    
    <div class="cards">
        <div class="card"><a href="image-modal2.php?image=art1.jpg&title=DECEIT & date=February 7th 2024"><img src="img/art1.jpg" alt="Card 1" ></a></div>
        <div class="card"><a href="image-modal2.php?image=art7.jpg&title=PANDEMONIUM & date=April 27th 2023"><img src="img/art7.jpg" alt="Card 2"></a></div>
        <div class="card"><a href="image-modal2.php?image=art3.jpg&title=EAGLES & date=February 17th 2024"><img src="img/art3.jpg" alt="Card 3"></a></div>
    </div>
    
    <div class="cards">
        <div class="card"><a href="image-modal2.php?image=art4.jpg&title=REMNANT & date=February 7th 2024"><img src="img/art4.jpg" alt="Card 1"></a></div>
        <div class="card"><a href="image-modal2.php?image=art5.png&title=REDEMTION & date=April 1s 2021"><img src="img/art5.png" alt="Card 2"></a></div>
        <div class="card"><a href="image-modal2.php?image=ar6.png&title=REMORSE & date=March 31st 2021"><img src="img/ar6.png" alt="Card 3"></a></div>
    </div>

    <div class="cards">
        <div class="card"><a href="image-modal2.php?image=art8.png&title=DIVULGE & date=August 10th 2021"><img src="img/art8.png" alt="Card 1"></a></div>
        <div class="card"><a href="image-modal2.php?image=art9.jpg&title=EGO & date=February 7th 2024"><img src="img/art9.jpg" alt="Card 2"></a></div>
        <div class="card"><a href="image-modal2.php?image=art10.png&title=RYUJIN & date=May 3rd 2021"><img src="img/art10.png" alt="Card 3"></a></div>
    </div>

    <div class="cards">
        <div class="card"><a href="image-modal2.php?image=art11.jpg&title=FEALTY & date=February 7th 2024"><img src="img/art11.jpg" alt="Card 1"></a></div>
        <div class="card"><a href="image-modal2.php?image=art12.png&title=SYNERGY & date=July 12th 2021"><img src="img/art12.png" alt="Card 2"></a></div>
        <div class="card"><a href="image-modal2.php?image=art133.jpg&title=EXODUS & date=February 7th 2024"><img src="img/art133.jpg" alt="Card 3"></a></div>
    </div>

    <div class="cards">
        <div class="card"><a href="image-modal2.php?image=art14.jpg&title=GRIM & date=February 7th 2024"><img src="img/art14.jpg" alt="Card 1"></a></div>
        <div class="card"><a href="image-modal2.php?image=art15.png&title=ENDURE & date=March 31st 2021"><img src="img/art15.png" alt="Card 2"></a></div>
        <div class="card"><a href="image-modal2.php?image=art16.png&title=VALOR & date=April 5th 2021"><img src="img/art16.png" alt="Card 3"></a></div>
    </div>

    <div class="cards">
        <div class="card"><a href="image-modal2.php?image=art17.jpg&title=NECTAR & date=February 7th 2024"><img src="img/art17.jpg" alt="Card 1"></a></div>
        <div class="card"><a href="image-modal2.php?image=art18.png&title=ETERNITY & date=May 11th 2021"><img src="img/art18.png" alt="Card 2"></a></div>
        <div class="card"><a href="image-modal2.php?image=art19.png&title=REVIVAL & date=April 2nd 2021"><img src="img/art19.png" alt="Card 3"></a></div>
    </div>



    <footer>
    <p>© Copyright <strong>Jolsluominen</strong>. All Rights Reserved</p>
    <p>Design / Web Made by: <strong>Shandy Pacana</strong></p>
</footer>
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