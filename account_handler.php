<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_grocery_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$output = ''; // Initialize the variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $viewOption = $_POST["viewTransactions"];

    $present_user_result = $conn->query("SELECT `Customer ID` FROM present_user_id");
    if ($present_user_result->num_rows > 0) {
        $user_row = $present_user_result->fetch_assoc();
        $user_id = $user_row['Customer ID'];

        if ($viewOption == "all" || $viewOption == "month" || $viewOption == "last3months" || $viewOption == "year") {
            $sql = "SELECT t.`Transaction ID`, i.`Name`, c.Quantity FROM transactions t
                    JOIN carts c ON t.`Transaction ID` = c.`Transaction ID`
                    JOIN inventory i ON c.`Item number` = i.`Item number`
                    WHERE c.`Customer ID` = ?";

            if ($viewOption == "month") {
                $sql .= " AND MONTH(t.`Transaction Date`) = MONTH(NOW())";
            } elseif ($viewOption == "last3months") {
                $sql .= " AND t.`Transaction Date` >= CURDATE() - INTERVAL 3 MONTH";
            } elseif ($viewOption == "year") {
                $sql .= " AND YEAR(t.`Transaction Date`) = YEAR(NOW())";
            }

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->bind_result($TransactionID, $itemName, $quantity);

            echo "<h2>Transaction Details</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Transaction ID</th><th>Item Name</th><th>Quantity</th></tr>";

            while ($stmt->fetch()) {
                echo "<tr><td>$TransactionID</td><td>$itemName</td><td>$quantity</td></tr>";
            }

            echo "</table>";

            $stmt->close();
        } else {
            echo "Invalid view option.";
        }
    } else {
        die("Error: No user_id found in present_user_id");
    }

    $conn->close();
}
?>
