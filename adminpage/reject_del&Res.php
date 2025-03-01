<?php
// Include database connection
include './database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if delete button was clicked
    if (isset($_POST['delete'])) {
        $email_id = intval($_POST['email_id']); // Get the email ID from the form input
        
        // SQL query to delete the email entry
        $sql = "DELETE FROM archived_contacts WHERE id = ?";
        
        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("i", $email_id);
            if ($stmt->execute()) {
                // Redirect back to inbox with success message
                header("Location: index.php?page=Rejected&message=Email deleted successfully.");
                exit(); 
            } else {    
                // Handle execution error
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            // Handle prepare error
            echo "Error: " . $con->error;
        }
    }

    // Check if restore button was clicked
    if (isset($_POST['restore'])) {
        $email_id = intval($_POST['email_id']); // Get the email ID from the form input

        // Fetch the user_id and message from the archived_contacts table
        $sqlFetch = "SELECT user_id, users_messages FROM archived_contacts WHERE id = ?";
        if ($stmtFetch = $con->prepare($sqlFetch)) {
            $stmtFetch->bind_param("i", $email_id);
            $stmtFetch->execute();
            $result = $stmtFetch->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user_id = $row['user_id'];
                $user_message = $row['users_messages'];

                // Insert the fetched data back into the contacts table
                $sqlRestore = "INSERT INTO contacts (user_id, users_messages) VALUES (?, ?)";
                if ($stmtRestore = $con->prepare($sqlRestore)) {
                    $stmtRestore->bind_param("is", $user_id, $user_message);
                    $stmtRestore->execute();
                    $stmtRestore->close();

                    // Now delete the entry from archived_contacts
                    $sqlDelete = "DELETE FROM archived_contacts WHERE id = ?";
                    if ($stmtDelete = $con->prepare($sqlDelete)) {
                        $stmtDelete->bind_param("i", $email_id);
                        if ($stmtDelete->execute()) {
                            // Redirect back to inbox with success message
                            header("Location: index.php?page=inbox_list&message=Email restored successfully.");
                            exit();
                        } else {
                            // Handle execution error for delete
                            echo "Error: " . $stmtDelete->error;
                        }
                        $stmtDelete->close();
                    }
                } else {
                    // Handle prepare error for restore
                    echo "Error: " . $con->error;
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
