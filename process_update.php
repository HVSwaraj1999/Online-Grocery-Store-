<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected itemNumber and quantityIncrease from the form
    $selectedItemNumber = $_POST['itemNumber'];
    $quantityIncrease = $_POST['quantityIncrease'];

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
        $sqlSelect = "SELECT `Quantity`, `Name` FROM inventory WHERE `Item number` = :ItemNumber";
        $stmtSelect = $conn->prepare($sqlSelect);
        $stmtSelect->bindParam(':ItemNumber', $selectedItemNumber);
        $stmtSelect->execute();

        $row = $stmtSelect->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $currentQuantity = $row['Quantity'];
            $itemName = $row['Name'];

            // Calculate the new quantity
            $newQuantity = $currentQuantity + $quantityIncrease;

            // Update the quantity in the database
            $sqlUpdate = "UPDATE inventory SET `Quantity` = :NewQuantity WHERE `Item number` = :ItemNumber";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':ItemNumber', $selectedItemNumber);
            $stmtUpdate->bindParam(':NewQuantity', $newQuantity);
            $stmtUpdate->execute();

            //alert( "Data updated successfully for Item number: $selectedItemNumber. New Quantity: $newQuantity. Item Name: $itemName");
			
            // Update XML file
            $xml = simplexml_load_file('inventory.xml');
            foreach ($xml->product as $product) {
                if ((string)$product->Name == $itemName) {
                    $product->Quantity = $newQuantity;
                    break;
                }
            }
            $xml->asXML('inventory.xml');

            // Update JSON file
            $json = json_decode(file_get_contents('inventory.json'), true);
            foreach ($json['products']['product'] as &$product) {
                if ($product['Name'] == $itemName) {
                    $product['Quantity'] = $newQuantity;
                    break;
                }
            }
			header("Location: updata.php");
			exit();
            file_put_contents('inventory.json', json_encode($json, JSON_PRETTY_PRINT));
        } else {
		//alert( "Item not found in the database.");
			header("Location: updata.php");
			exit();
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
