<?php
// Include your database connection logic here

// Fetch and display content from the inventory table
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_grocery_store";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM inventory");

    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>Item ID</th><th>Item Name</th><th>Quantity</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['Item number']}</td><td>{$row['Name']}</td><td>{$row['Quantity']}</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No data available.";
    }

    $conn->close();
?>
        