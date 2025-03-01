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
    <meta charset="utf-8">
    <title>Artist Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <div class="container bootdey">
        <div class="email-app mb-4">
            <nav>
                <a href="index.php" class="btn btn-dark btn-block">Jols.Louminen</a>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=dashboard"><i class="fa fa-star"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=inbox_list"><i class="fa fa-inbox"></i> Inbox</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=done"><i class="fa fa-check"></i> Done It!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=Rejected"><i class="fa fa-trash-o"></i> Rejected</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=accounts"><i class="fa fa-person"></i> UsersAccount</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="fa fa-off"></i> Logout</a>
                    </li>
                </ul>
            </nav>

            <?php
            // Get the page value from the URL
            $page = $_GET['page'] ?? 'dashboard'; // default to dashboard if no page is set

            switch ($page) {
                case 'inbox_list':
                    include 'inbox.php'; // Show inbox list
                    break;
                    
                    case 'done':
                        include 'done.php'; // Show inbox list
                        break;     

                case 'Rejected':
                    include 'rejected_list.php'; // Show rejected list
                    break;

                    case 'accounts':
                        include 'accounts.php'; // Show rejected list
                        break;

                case 'dashboard':
                default: // Show dashboard stats by default
                    include 'dashboard.php'; // Separate dashboard logic into its own file
                    break;
            }
            ?>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</body>
</html>
