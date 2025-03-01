<?php
// Include database connection
include './database/connection.php';

// SQL query to fetch user emails and messages by joining archived_contacts with user_account
$sql = "SELECT ac.id, ua.user_email, ac.users_messages, ac.archived_at 
        FROM archived_contacts ac
        JOIN user_account ua ON ac.user_id = ua.user_id";  // Joining to get user_email
$result = $con->query($sql);

// Check if the query was successful
if ($result === false) {
    // Output the SQL error for debugging
    echo "Error: " . $con->error;
    exit; // Stop further execution if query fails
}
?>

<main class="inbox">
    <ul class="messages">
    <div class="title">
                <span class="from">Rejected List </span>
            </div>
        <?php
        // Check if there are any results from the query
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $id = $row['id']; // Assuming 'id' is the primary key in the 'archived_contacts' table
                $user_email = htmlspecialchars($row['user_email']);
                $user_message = htmlspecialchars($row['users_messages']);
                $archived_at = htmlspecialchars($row['archived_at']);
        ?>
        <li class="message unread" style="background: linear-gradient(to bottom, white, lightcoral); padding: 20px; border-radius: 10px; margin-bottom: 10px;" >
            <div class="actions">
                <!-- Actions can be added here if needed -->
            </div>
            <div class="header">
                <span class="from">You Rejected the client </span>
            </div>
            <div class="title">
                <?php echo $user_email; ?>
            </div>
            <div class="description">
                <?php echo $user_message; ?>
            </div>
            <!-- Delete and Restore buttons -->
            <div class="email-actions" style="text-align: right;">
                <form action="reject_del&Res.php" method="post" style="display:inline-block;">
                    <input type="hidden" name="email_id" value="<?php echo $id; ?>">
                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                </form>
                <form action="reject_del&Res.php" method="post" style="display:inline-block;">
                    <input type="hidden" name="email_id" value="<?php echo $id; ?>">
                    <button type="submit" name="restore" class="btn btn-success">Restore</button>
                </form>
            </div>
            <div class="description" style="text-align: right; font-size: small; color: ;">
               Rejected on: <?php echo $archived_at; ?>
            </div>
        </li>
        <?php
            }
        } else {
            echo "<li>No Rejected Commissions. Keep it up!.</li>";
        }
        ?>
    </ul>
</main>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
