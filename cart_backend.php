<?php
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "online_grocery_store"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT 
            c.`Item number` AS ItemID, c.Quantity, 
            i.Name AS ItemName, i.Category, i.SubCategory, i.Unit_price,
            t.`Transaction ID`
        FROM carts c
        JOIN inventory i ON c.`Item number` = i.`Item number`
        JOIN transactions t ON c.`Transaction ID`= t.`Transaction ID`
		WHERE c.`Cart status`='IN_CART'";

$result = $conn->query($sql);
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}


$conn->close();
// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
