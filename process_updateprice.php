<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected itemNumber and quantityIncrease from the form
    $selectedItemNumber = $_POST['itemNumber'];
    $priceIncrease = $_POST['priceIncrease'];

    // Add your database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "online_grocery_store";

    try {
        // Database update
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch the current quantity from the database
        $sqlSelect = "SELECT `Unit_price`, `Name` FROM inventory WHERE `Item number` = :ItemNumber";
        $stmtSelect = $conn->prepare($sqlSelect);
        $stmtSelect->bindParam(':ItemNumber', $selectedItemNumber);
        $stmtSelect->execute();

        $row = $stmtSelect->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $currentUnitPrice = $row['Unit_price'];
            $itemName = $row['Name'];

            // Update the unit price in the database
            $sqlUpdate = "UPDATE inventory SET `Unit_price` = :NewPrice WHERE `Item number` = :ItemNumber";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':ItemNumber', $selectedItemNumber);
            $stmtUpdate->bindParam(':NewPrice', $priceIncrease);
            $stmtUpdate->execute();

            // Update XML file
            $xml = simplexml_load_file('inventory.xml');
            foreach ($xml->product as $product) {
                if ((string)$product->Name == $itemName) {
                    $product->Unit_price = $priceIncrease;
                    break;
                }
            }
            $xml->asXML('inventory.xml');

            // Update JSON file
            $json = json_decode(file_get_contents('inventory.json'), true);
            foreach ($json['products']['product'] as &$product) {
                if ($product['Name'] == $itemName) {
                    $product['Unit_price'] = $priceIncrease;
                    break;
                }
            }

            file_put_contents('inventory.json', json_encode($json, JSON_PRETTY_PRINT));

            // Redirect after processing
            header("Location: updataprice.php");
            exit();
        } else {
            // Item not found in the database
            header("Location: updataprice.php");
            exit();
        }
    } catch (PDOException $e) {
        // Log or display the error message
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
