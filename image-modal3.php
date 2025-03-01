<?php
// Retrieve image and title from URL query parameters
$image = isset($_GET['image']) ? $_GET['image'] : 'default.jpg';
$title = isset($_GET['title']) ? $_GET['title'] : 'Untitled';
$published_date = isset($_GET['date']) ? $_GET['date'] : 'Unknown Date';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> - Commission Page</title>
    <link rel="stylesheet" href="cssdesign/imgstyle.css">
    <link rel="stylesheet" href="cssdesign/font.css">
</head>
<body>

    <!-- Art Piece Section -->
    <div class="art-section">
        <!-- Display the dynamic image from URL -->
        <img src="img/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($title); ?>" class="art-image">
        
        <!-- Art details with dynamic title and date -->
        <div class="art-details">
            <h1><?php echo htmlspecialchars($title); ?></h1>
            <div class="date"><p><strong>Published:</strong> <?php echo htmlspecialchars($published_date); ?></p></div>
            <div class="detail">
                <p>If you're interested in commissioning custom artwork or purchasing an existing piece, 
                    I'd love to work with you! Whether you're looking for digital illustrations, branding designs,
                    or unique creative projects tailored to your vision, feel free to reach out.</p>
            </div>
            <!-- Link to contact page -->
            <a href="login.php" class="contact-button">Contact Us</a>
        </div>

        <!-- Close button to go back to the main page -->
        <a href="about.php" class="close-icon">X</a>
    </div>

</body>
</html>
