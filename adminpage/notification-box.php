<style>
.notification-box {
    position: fixed;
    bottom: 0;
    right: 20px;
    background-color: #ffffff;
    border: 1px solid #ccc;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    padding: 20px;
    width: 300px;
    font-family: Arial, sans-serif;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin-top: 20%;
    margin-left: 40%;
}

.notification-header {
    font-size: 1.2em;
    color: #333;
}

.chat-box {
    max-height: 600px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
}

.chat-message {
    margin-bottom: 10px;
    padding: 8px;
    border-radius: 5px;
    color: #333;
}

.artist-message {
    background-color: #007bff; /* Blue for artist messages */
    color: white;
    align-self: flex-end; /* Align artist messages to the right */
}

.user-message {
    background-color: #f1f1f1; /* Grey for user messages */
    align-self: flex-start; /* Align user messages to the left */
}

.chat-input {
    display: flex;
    margin-top: 10px;
}

.chat-input input[type="text"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.chat-input button {
    padding: 8px 12px;
    margin-left: 5px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.chat-input button:hover {
    background-color: #0056b3;
}
</style>

<?php 
include './database/connection.php'; // Ensure this file contains correct database connection code

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if (isset($_POST['message'])) {
    $user_message = $_POST["message"];
    $user_message = mysqli_real_escape_string($con, $user_message);

    // Insert artist message into the users_feedback table
    $sql = "INSERT INTO users_feedback (user_feedback, created_at) VALUES ('$user_message', NOW())";

    if ($con->query($sql) === TRUE) {
        // Fetch updated chat messages without redirecting
        $sql = "
            SELECT 'you' AS sender, user_feedback AS message, created_at
            FROM users_feedback
            UNION
            SELECT 'client' AS sender, user1_feedback AS message, created_at
            FROM users1_feedback
            ORDER BY created_at ASC";

        $result = $con->query($sql);
        if (!$result) {
            echo "Error fetching chat messages: " . $con->error; // Output any fetching error
        } else {
            // Display chat messages
            while ($row = $result->fetch_assoc()) {
                $message = htmlspecialchars($row['message']);
                $sender = $row['sender'];

                if ($sender == 'you') {
                    // Display artist's message (blue)
                    echo "<div class='chat-message artist-message'><strong>You:</strong> $message</div>";
                } else {
                    // Display client's message (grey)
                    echo "<div class='chat-message user-message'><strong>Shandy:</strong> $message</div>";
                }
            }
        }
        exit(); // Stop further execution
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

// Fetch all messages initially (you as sender and client as receiver)
$sql = "
    SELECT 'you' AS sender, user_feedback AS message, created_at
    FROM users_feedback
    UNION
    SELECT 'client' AS sender, user1_feedback AS message, created_at
    FROM users1_feedback
    ORDER BY created_at ASC"; // Order messages by created time in ascending order

$result = $con->query($sql);
if (!$result) {
    echo "Error fetching chat messages: " . $con->error; // Output any fetching error
}
?>

<div class="notification-box">
    <div class="notification-header">
        <strong>Chat Box</strong>
    </div>
    
    <div class="chat-box" id="chat-box">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $message = htmlspecialchars($row['message']);
                $sender = $row['sender'];

                if ($sender == 'you') {
                    // Display artist's message (blue)
                    echo "<div class='chat-message artist-message'><strong>You:</strong> $message</div>";
                } else {
                    // Display client's message (grey)
                    echo "<div class='chat-message user-message'><strong>Shandy:</strong> $message</div>";
                }
            }
        } else {
            echo "<div class='chat-message'>No messages yet.</div>";
        }
        ?>
    </div>
    
    <!-- Input field and Send button -->
    <form class="chat-input" id="chat-form" action="" method="POST">
        <input type="text" name="message" placeholder="Type your message..." required>
        <button type="submit">Send</button>
    </form>
</div>
