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

        if ($action === "customerTransactionsByZipAndMonth") {
            // Retrieve entered zip code and month
            $zipCode = $_POST["zipCode"];
            $selectedMonth = $_POST["selectedMonth"];

            // Query to get customers with more than 2 transactions in the specified zip code and month
            $sql = "SELECT c.`Customer ID`, COUNT(t.`Transaction ID`) as transactionCount 
                    FROM transactions t
                    JOIN carts c ON c.`Transaction ID` = t.`Transaction ID`
					JOIN customers cu ON cu.`Customer ID` = c.`Customer ID`
                    WHERE cu.`Address` LIKE ? AND MONTH(t.`Transaction Date`) = ? 
                    GROUP BY c.`Customer ID` 
                    HAVING transactionCount > 2";

            $stmt = $conn->prepare($sql);
            $zipCodeParam = "%$zipCode%"; // Add % around zip code for partial match
            $stmt->bind_param("ss", $zipCodeParam, $selectedMonth);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<h3>Customers in Zip Code $zipCode with More than 2 Transactions in $selectedMonth:</h3>";
                echo "<table class='table'>";
                echo "<thead><tr><th>Customer ID</th><th>Transaction Count</th></tr></thead><tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['Customer ID']}</td><td>{$row['transactionCount']}</td></tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "No customers in Zip Code $zipCode with more than 2 transactions in $selectedMonth.";
            }

            $stmt->close();
        }

        $conn->close();
    }
}
?>
