<?php
$servername = "localhost"; // Change if necessary
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "user"; // Your database name

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
