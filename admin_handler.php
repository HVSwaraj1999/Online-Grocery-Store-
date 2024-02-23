<!-- admin_handler.php -->

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

            if ($action === "customerTransactions") {
                // Retrieve entered date
                $transactionDate = $_POST["transactionDate"];

                // Query to get customers with more than 2 transactions on the specified date
                $sql = "SELECT c.`Customer ID`, COUNT(t.`Transaction ID`) as transactionCount 
						FROM transactions t
						JOIN carts c ON c.`Transaction ID` = t.`Transaction ID`
						WHERE DATE(t.`Transaction Date`) = ? 
						GROUP BY c.`Customer ID` 
						HAVING transactionCount > 2";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $transactionDate);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<h3>Customers with More than 2 Transactions on $transactionDate:</h3>";
                    echo "<table class='table'>";
                    echo "<thead><tr><th>Customer ID</th><th>Transaction Count</th></tr></thead><tbody>";
                    
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>{$row['Customer ID']}</td><td>{$row['transactionCount']}</td></tr>";
                    }
                    
                    echo "</tbody></table>";
                } else {
                    echo "No customers with more than 2 transactions on $transactionDate.";
                }

                $stmt->close();
            }

            $conn->close();
        }
    }
?>
