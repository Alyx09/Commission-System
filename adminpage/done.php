<?php
// Include database connection
include './database/connection.php';

// SQL query to fetch completed commissions, ordered by date
$sql = "
    SELECT c.id, ua.user_email, c.users_messages, c.amount, c.created_at 
    FROM completed c
    JOIN user_account ua ON c.user_id = ua.user_id 
    ORDER BY c.created_at DESC"; // Order by date descending

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
                $id = $row['id']; // Primary key in the 'completed' table
                $user_email = htmlspecialchars($row['user_email']);
                $user_message = htmlspecialchars($row['users_messages']);
                $amount = number_format($row['amount'], 2); // Format amount to 2 decimal places
                $created_at = date("Y-m-d H:i:s", strtotime($row['created_at'])); // Format created_at
        ?>
        <li class="message unread" style="background: linear-gradient(to bottom, white, lightgreen); padding: 20px; border-radius: 10px; margin-bottom: 10px; position: relative;">
            <!-- Delete icon with a link to delete the message -->
            <a href="delete_done.php?id=<?php echo $id; ?>" style="position: absolute; top: 10px; right: 10px; color: red; text-decoration: none; font-size: 1.8em;">&times;</a>
            <div class="actions">
            </div>
            <div class="header">
                <span class="from">Commission Complete!!</span>
            </div>
            <div class="title">
                <?php echo $user_email; ?>
            </div>
            <div class="description">
                <?php echo $user_message; ?>
            </div>
            <!-- Display payment amount with increased font size -->
            <div class="email-actions" style="text-align: right; font-size: 1.5em; font-weight: bold;">
                $<?php echo $amount; ?>
            </div>
            <!-- Display created_at timestamp -->
            <div style="text-align: right; font-size: small; color: gray;">
                Done in: <?php echo $created_at; ?>
            </div>
        </li>
        <?php
            }
        } else {
            echo "<li>You still have no completed commissions yet.  for noow :( </li>";
        }
        ?>
    </ul>
</main>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
