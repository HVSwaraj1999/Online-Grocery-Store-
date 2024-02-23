<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        $action = $_POST["action"];

        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "online_grocery_store";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($action === "t3a20") {
            // Query to get customers older than 20 with more than 3 transactions
            $sql = "SELECT c.`Customer ID`, c.`First Name`, c.`Last Name`, c.`Age`, COUNT(t.`Transaction ID`) as transactionCount
                    FROM customers c
                    LEFT JOIN carts ca ON c.`Customer ID` = ca.`Customer ID`
                    LEFT JOIN transactions t ON ca.`Transaction ID` = t.`Transaction ID`
                    WHERE c.`Age` > 20
                    GROUP BY c.`Customer ID`
                    HAVING transactionCount > 3";

            $result = $conn->query($sql);
			//$result = $conn->query($sql);

			if (!$result) {
				echo "Error: " . $conn->error;
			}

            if ($result->num_rows > 0) {
                echo "<h3>Customers Older Than 20 with More than 3 Transactions:</h3>";
                echo "<table class='table'>";
                echo "<thead><tr><th>Customer ID</th><th>First Name</th><th>Last Name</th><th>Age</th><th>Transaction Count</th></tr></thead><tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['Customer ID']}</td>";
                    echo "<td>{$row['First Name']}</td>";
                    echo "<td>{$row['Last Name']}</td>";
                    echo "<td>{$row['Age']}</td>";
                    echo "<td>{$row['transactionCount']}</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "No customers older than 20 with more than 3 transactions.";
            }
        }

        $conn->close();
    }
}
?>
