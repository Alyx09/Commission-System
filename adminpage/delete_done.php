<?php
// Include database connection
include './database/connection.php';

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the delete statement
    $stmt = $con->prepare("DELETE FROM completed WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to the inbox page
        header("Location: index.php?page=done&message=Message deleted successfully.");
        exit();
    } else {
        echo "Error deleting message: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No ID specified.";
}

// Close the database connection
$con->close();
?>
