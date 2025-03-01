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
    <title>JOLS.LUOMINEN</title>
    <link rel="stylesheet" href="cssdesign/style5.css">
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
            margin: 0 55px; 
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

    <!-- Main Content -->
    <div class="main-content">
        <!-- Logo Section -->
        <div class="logo-section">
            <img src="img/jolsec.png" alt="JOLS.LUOMINEN Logo" class="logo">
        </div>

        <!-- Image Section -->
        <div class="image-section">
            <img src="img/coverphoto.png" alt="Workstation Image" class="workstation-image">
        </div>

        <!-- Text Section -->
        <div class="text-section">
            <h1>HI I'M JOLS</h1>
            <p>I primarily work as a freelancer, focusing on commissioned-based projects. I offer clients custom branding solutions and 
                digital artwork tailored to their needs. Each piece I create is driven by a passion for unique design, ensuring my clients 
                get something personalized and meaningful.</p>
        </div>

        <div class="cards">
            <div class="card"><a href="image-modal3.php?image=art11.jpg&title=FEALTY & date=February 7th 2024"><img src="img/art11.jpg" alt="Card 1"></a></div>
            <div class="card"><a href="image-modal3.php?image=art14.jpg&title=GRIM & date=February 7th 2024"><img src="img/art14.jpg" alt="Card 2"></a></div>
            <div class="card"><a href="image-modal3.php?image=art9.jpg&title=EGO & date=February 7th 2024"><img src="img/art9.jpg" alt="Card 3"></a></div>
        </div>

        <div id='howitallstarted' class='howitallstarted'> How it all started</div>

        <div id='howit' class='howit'>My journey began during the pandemic. Like many others, 
            I found myself with more free time than I knew what to do with, and boredom led me 
            to explore my creative side. What started as a hobby quickly turned into a passion, 
            and eventually, a career in freelancing and digital art.
        </div>

        <div id='what' class='what'> What i do</div>

        <div id='whati' class='whati'>I specialize in creating branding materials and digital art. 
            Whether it's a logo, social media content, or personalized artwork, I focus on helping 
            individuals and businesses build their visual identity. My goal is to bring ideas to 
            life in a way that's both creative and professional.
        </div>
        
        
    </div>
        
        <div id='rectangle15' class='rectangle15'> 
            <img id='profilephoto' class='profilephoto' src="img/profilephoto.png">
            <div id='whatinspiresme' class='whatinspiresme'>What inspires me</div>

            <div id='whatis' class='whatis'>As a digital artist, my inspiration comes from a variety of 
                sources that fuel my creativity and drive my passion for design.
                <h>"Technology and Innovation"</h> play a major role in my work. The rapid 
                advancement of digital tools allows me to constantly explore new 
                techniques and push the boundaries of what I can create. The ability 
                to experiment with colors, textures, and effects digitally gives me 
                a sense of freedom and excitement that I find truly inspiring.
            </div>


        
        </div>
        <div id='whatisjolsluominen?' class='text3'>
            FOLLOW ME ON
           </div>


        <div class="social-links">
            <a href="https://instagram.com" target="_blank"><img src="img/instagram.png" alt="Instagram"></a>
            <a href="https://facebook.com" target="_blank"><img src="img/facebook.png" alt="Facebook"></a>
            <a href="https://twitter.com" target="_blank"><img src="img/twitter.png" alt="Twitter"></a>
    
        </div>

        <section class="contact-section">
            <div class="contact-container">
                <h3>Want to Work Together?</h3>
                <p>Whether you're a brand or potential licensing client looking for art for your products or if you're looking for wholesale products for your shop, I can't wait to learn more about you! Please contact me and I'll get back to you within 24-48 hours!</p>
               <a href="contact.php" <button class="contact-btn">Contact Us</button></a>
                
            </div>
        </section>

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








