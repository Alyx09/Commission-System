<?php
// Include database connection
include './database/connection.php';

// SQL query to fetch user emails and messages
$sql = "
    SELECT c.id, ua.user_email, c.users_messages
    FROM contacts c
    JOIN user_account ua ON c.user_id = ua.user_id"; // Join to fetch user emails

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
        <?php
        // Check if there are any results from the query
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $id = $row['id']; // Assuming 'id' is the primary key in the 'contact' table
                $user_email = htmlspecialchars($row['user_email']);
                $user_message = htmlspecialchars($row['users_messages']);
        ?>
        <li class="message unread">
            <div class="actions">
                <!-- Actions can be added here if needed -->
            </div>
            <div class="header">
                <span class="from">You have a new client</span>
            </div>
            <div class="title">
                <?php echo $user_email; ?>
            </div>
            <div class="description">
                <?php echo $user_message; ?>
            </div>
            <!-- Reject and Done buttons -->
            <div class="email-actions" style="text-align: right;">
                <form action="reject.php" method="post" style="display:inline-block;">
                    <input type="hidden" name="email_id" value="<?php echo $id; ?>">
                    <button type="submit" name="delete" class="btn btn-danger">Reject</button>
                </form>
                <form action="javascript:void(0);" style="display:inline-block;">
                    <input type="hidden" name="email_id" value="<?php echo $id; ?>">
                    <button type="button" class="btn btn-success" onclick="showModal(<?php echo $id; ?>)">Done</button>
                </form>
                <!-- Updated Reply button to use JavaScript -->
                <button class="btn btn-primary" onclick="showNotification()">Reply</button>
            </div>
        </li>
        <?php
            }
        } else {
            echo "<li>No Messages Yet.</li>";
        }
        ?>
    </ul>
                
                            <!-- Include the CSS file -->
                <link rel="stylesheet" href="css/stylemodal.css">

                <!-- Payment Survey Modal -->
                <div id="paymentModal" class="modal-container" style="display:none;">
                    <div class="modal-inner-content">
                        <span class="modal-close" onclick="closeModal()">&times;</span>
                        <h3>How much did he pay you?</h3>
                        <form id="paymentForm" action="submit_payment.php" method="post">
                            <input type="hidden" name="email_id" id="email_id">
                            <input type="number" name="amount" id="amount" placeholder="Enter Amount Here" required>
                            <button type="submit" class="submit-button">Submit</button>
                        </form>
                    </div>
                </div>

                <!-- Notification Box (hidden by default) -->
                <div id="notification-box" style="display: none;">
                    <?php include 'notification-box.php'; ?>
                </div>
</main>

<script>
    // Function to toggle the notification box
    function showNotification() {
        var notificationBox = document.getElementById('notification-box');
        if (notificationBox.style.display === 'block') {
            notificationBox.style.display = 'none'; // Hide if currently displayed
        } else {
            notificationBox.style.display = 'block'; // Show if currently hidden
        }
    }

    // Show modal when the Done button is clicked
    function showModal(id) {
        document.getElementById('email_id').value = id; // Set the email ID in hidden input
        document.getElementById('paymentModal').style.display = 'block'; // Show modal
    }

    // Close the modal
    function closeModal() {
        document.getElementById('paymentModal').style.display = 'none';
    }
</script>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
