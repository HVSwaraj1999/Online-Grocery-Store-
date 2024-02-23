<?php
// Start or resume the session
session_start();

// Clear specific data in the present_user_id table
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_grocery_store"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->query("DELETE FROM present_user_id");

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the index page
header("Location: index.php");
exit();
?>
