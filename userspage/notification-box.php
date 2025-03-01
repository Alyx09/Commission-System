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
    background-color: #f1f1f1;
    align-self: flex-start;
}

.user-message {
    background-color: #007bff;
    color: white;
    align-self: flex-end;
}

.chat-input {
    display: flex;
    margin-top: 10px;
    display: none; /* Initially hide the input field */
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

    // Insert user message into the users1_feedback table
    $sql = "INSERT INTO users1_feedback (user1_feedback, created_at) VALUES ('$user_message', NOW())";

    if ($con->query($sql) === TRUE) {
        // Redirect to avoid form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

// Fetch all messages (artist and user) ordered by time
$sql = "
    SELECT 'artist' AS sender, user_feedback AS message, created_at
    FROM users_feedback
    UNION
    SELECT 'user' AS sender, user1_feedback AS message, created_at
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
    
    <div class="chat-box">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $message = htmlspecialchars($row['message']);
                $sender = $row['sender'];

                if ($sender == 'artist') {
                    // Display artist's message
                    echo "<div class='chat-message artist-message'><strong>Artist:</strong> $message</div>";
                } else {
                    // Display user's message
                    echo "<div class='chat-message user-message'><strong>You:</strong> $message</div>";
                }
            }
        } else {
            echo "<div class='chat-message'>In order to message with the artist, just go to CONTACT first and start the conversation. Thank You!</div>";
        }
        ?>
    </div>
    
    <!-- Input field and Send button -->
    <form class="chat-input" action="" method="POST" id="chat-form">
        <input type="text" name="message" id="message-input" placeholder="Type your message..." required>
        <button type="submit">Send</button>
    </form>
</div>

<script>
// Check if there are any artist messages in the chat box
const artistMessages = document.querySelectorAll('.artist-message');

if (artistMessages.length > 0) {
    // Show the input field if there are artist messages
    document.querySelector('.chat-input').style.display = 'flex';
}

// Listen for the form submit event
document.getElementById('chat-form').addEventListener('submit', function(event) {
    const messageInput = document.getElementById('message-input');
    if (messageInput.value.trim() === '') {
        // Prevent form submission if the input is empty
        event.preventDefault();
        alert('Please type a message before sending.');
    }
});
</script>
