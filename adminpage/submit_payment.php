<?php
// Include database connection
include './database/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_id = $_POST['email_id'];
    $amount = $_POST['amount'];

    // Check if email_id and amount are valid
    if (!empty($email_id) && !empty($amount)) {
        // Start transaction
        $con->begin_transaction();

        try {
            // Step 1: Move the message from `contacts` to `completed`
            $move_query = "
                INSERT INTO completed (user_id, users_messages, amount)
                SELECT user_id, users_messages, ? 
                FROM contacts WHERE id = ?";
                
            $stmt = $con->prepare($move_query);
            if ($stmt === false) {
                throw new Exception("Prepare failed: " . $con->error);
            }
            $stmt->bind_param("di", $amount, $email_id);

            if (!$stmt->execute()) {
                throw new Exception("Error moving message to completed: " . $stmt->error);
            }

            // Step 2: Delete the message from `contacts` table
            $delete_query = "DELETE FROM contacts WHERE id = ?";
            $stmt_delete = $con->prepare($delete_query);
            if ($stmt_delete === false) {
                throw new Exception("Prepare failed: " . $con->error);
            }
            $stmt_delete->bind_param("i", $email_id);

            if (!$stmt_delete->execute()) {
                throw new Exception("Error deleting message: " . $stmt_delete->error);
            }

            // Step 3: Delete all feedback entries from users_feedback and users1_feedback tables
            // No need to bind any parameters since you're deleting everything
            $delete_feedback_query1 = "DELETE FROM users_feedback";
            if (!$con->query($delete_feedback_query1)) {
                throw new Exception("Error deleting feedback from users_feedback: " . $con->error);
            }

            $delete_feedback_query2 = "DELETE FROM users1_feedback";
            if (!$con->query($delete_feedback_query2)) {
                throw new Exception("Error deleting feedback from users1_feedback: " . $con->error);
            }

            // Commit transaction if all queries were successful
            $con->commit();
            header("Location: index.php?page=done&message=Email marked as done.");
            exit;
        } catch (Exception $e) {
            // Rollback if any query fails
            $con->rollback();
            echo "Transaction failed: " . $e->getMessage();
        }
    } else {
        echo "Invalid input. Please make sure to fill out all fields.";
    }
}
?>
