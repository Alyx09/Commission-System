
<<?php 
include './database/connection.php';

$sql = "SELECT `user_email`, `users_messages` FROM `contact`";
$result = $con->query($sql);
?>

<table class="table datatable">
    <thead>
        <tr>
            <th>Email</th>
            <th>Message</th>
        </tr>  
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr> 
            <td><?php echo $row['user_email']; ?></td>
            <td><?php echo $row['users_messages']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>
