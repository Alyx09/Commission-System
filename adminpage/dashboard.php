<?php
// Include database connection
include './database/connection.php';

// Fetch counts and earnings from the database
$current_commissions = 0;
$completed_commissions = 0;
$rejected_commissions = 0;
$total_earnings = 0;

// Query for current commissions
$result = $con->query("SELECT COUNT(id) as count FROM contacts");
if ($result && $row = $result->fetch_assoc()) {
    $current_commissions = $row['count'];
}

// Query for completed commissions
$result = $con->query("SELECT COUNT(id) as count FROM completed");
if ($result && $row = $result->fetch_assoc()) {
    $completed_commissions = $row['count'];
}

// Query for rejected commissions
$result = $con->query("SELECT COUNT(id) as count FROM archived_contacts");
if ($result && $row = $result->fetch_assoc()) {
    $rejected_commissions = $row['count'];
}

// Query for total earnings
$result = $con->query("SELECT SUM(amount) as total FROM completed");
if ($result && $row = $result->fetch_assoc()) {
    $total_earnings = $row['total'] ?? 0;
}
?>

<main class='inbox'>
    <div class='dashboard-stats'>
        <div class='stat-box'>
            <div class='stat-text'>
                <h4>Current Commissions:</h4>
                <p><?php echo $current_commissions; ?></p>
            </div>
        </div>

        <div class='stat-box'>
            <div class='stat-text'>
                <h4>Completed Commissions:</h4>
                <p><?php echo $completed_commissions; ?></p>
            </div>
        </div>

        <div class='stat-box'>
            <div class='stat-text'>
                <h4>Total Earnings:</h4>
                <p>$<?php echo number_format($total_earnings, 2); ?></p>
            </div>
        </div>

        <div class='stat-box'>
            <div class='stat-text'>
                <h4>Rejected Commissions:</h4>
                <p><?php echo $rejected_commissions; ?></p>
            </div>
        </div>
    </div>
</main>
