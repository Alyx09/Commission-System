<?php
include './database/connection.php';
//see the data from the user_account table
$sql = "SELECT`user_id`, `user_name`, `user_password`, `user_email` FROM `user_account`";

 $result = $con->query($sql);



?>

<table class="table">
<thead>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        
    </th>
</thead>
<tbody>
    <?php  while($row = $result->fetch_assoc()): ?>
       <tr>

        <td><?php echo $row['user_id'];?></td>
        <td><?php echo $row['user_name'];?></td>
        <td><?php echo $row['user_password'];?></td>
        <td><?php echo $row['user_email'];?></td>
        <td colspan=3> 
            <button class="btn btn-danger">Delete</button>
        </td>

    </tr>
    <?php endwhile; ?>
  </tbody>
    

</table>