<?php
    // Fetch and display low inventory items
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "online_grocery_store";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM inventory WHERE Quantity < 3");

    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>Item ID</th><th>Item Name</th><th>Quantity</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            //echo "<tr><td>{$row['item_id']}</td><td>{$row['item_name']}</td><td>{$row['quantity']}</td></tr>";
			echo "<tr><td>{$row['Item number']}</td><td>{$row['Name']}</td><td>{$row['Quantity']}</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No low inventory items.";
    }

    $conn->close();
?>