<?php
// Include database connection
include './database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if delete button was clicked
    if (isset($_POST['delete'])) {
        $email_id = intval($_POST['email_id']); // Get the ID from the form input

        // Fetch user_id and message from the contacts table
        $sqlFetch = "SELECT user_id, users_messages 
                     FROM contacts 
                     WHERE id = ?";
        if ($stmtFetch = $con->prepare($sqlFetch)) {
            $stmtFetch->bind_param("i", $email_id);
            $stmtFetch->execute();
            $result = $stmtFetch->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user_id = $row['user_id']; // This is the user_id from contacts
                $user_message = $row['users_messages'];

                // Debugging output
                echo "User ID: " . $user_id . "<br>";
                echo "User Message: " . $user_message . "<br>";

                // Optional: If you need to get the user_email from the user_account table
                // Uncomment the next block if needed
                /*
                $sqlEmailFetch = "SELECT user_email FROM user_account WHERE user_id = ?";
                if ($stmtEmailFetch = $con->prepare($sqlEmailFetch)) {
                    $stmtEmailFetch->bind_param("i", $user_id);
                    $stmtEmailFetch->execute();
                    $resultEmail = $stmtEmailFetch->get_result();
                    if ($resultEmail->num_rows > 0) {
                        $rowEmail = $resultEmail->fetch_assoc();
                        $user_email = $rowEmail['user_email'];
                        echo "User Email: " . $user_email . "<br>"; // Debugging output
                    }
                    $stmtEmailFetch->close();
                }
                */

                // Insert the user_id and message into the archived_contacts table
                $sqlArchive = "INSERT INTO archived_contacts (user_id, users_messages, archived_at) 
                               VALUES (?, ?, NOW())";
                if ($stmtArchive = $con->prepare($sqlArchive)) {
                    $stmtArchive->bind_param("is", $user_id, $user_message);
                    $stmtArchive->execute();
                    $stmtArchive->close();
                }

                // Now delete the message from the original contacts table
                $sqlDelete = "DELETE FROM contacts WHERE id = ?";
                if ($stmtDelete = $con->prepare($sqlDelete)) {
                    $stmtDelete->bind_param("i", $email_id);
                    if ($stmtDelete->execute()) {
                        // Redirect back to inbox with success message
                        header("Location: index.php?page=inbox_list&message=Email archived successfully.");
                        exit();
                    } else {
                        // Handle execution error
                        echo "Error: " . $stmtDelete->error;
                    }
                    $stmtDelete->close();
                }
            } else {
                echo "No entry found with that ID.";
            }
            $stmtFetch->close();
        } else {
            // Handle prepare error
            echo "Error: " . $con->error;
        }
    }
}

// Close the database connection
$con->close();
?>
