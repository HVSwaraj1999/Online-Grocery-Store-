<?php
// Step 1: Read XML File
$xmlContent = file_get_contents('inventory.xml');
$xml = simplexml_load_string($xmlContent);

if ($xml === false) {
    die("Error loading XML");
}

// Step 2: Read JSON File
$jsonContent = file_get_contents('inventory.json');
$inventoryData = json_decode($jsonContent, true);

if ($inventoryData === null && json_last_error() !== JSON_ERROR_NONE) {
    die("Error decoding JSON: " . json_last_error_msg());
}

// Step 3: Connect to Database
$servername = "localhost";
$username = "root";  // Default username for XAMPP
$password = "";      // Default password for XAMPP
$dbname = "online_grocery_store";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// Step 2: Clear existing data from the inventory table
	$clearTableSql = "TRUNCATE TABLE inventory";
    $conn->exec($clearTableSql);

    // Step 3: Reset auto-increment to 1
    $resetAutoIncrementSql = "ALTER TABLE inventory AUTO_INCREMENT = 1";
    $conn->exec($resetAutoIncrementSql);

    // Step 5: Insert Data from XML into Database
    foreach ($xml->product as $product) {
        $name = (string)$product->Name;
        $category = (string)$product->Category;
        $subcategory = (string)$product->Subcategory;
        $price = (float)$product->price;
        $image = (string)$product->Image;
        $quantity = (int)$product->Quantity;

        $sql = "INSERT INTO inventory (`name`, `category`, `subcategory`, `Unit_price`, `image`, `quantity`) 
                VALUES (:name, :category, :subcategory, :price, :image, :quantity)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':subcategory', $subcategory);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':quantity', $quantity);

        $stmt->execute();
       // echo "Record inserted successfully from XML<br>";
    }

    // Step 6: Insert Data from JSON into Database
    if (isset($inventoryData['products']['product']) && is_array($inventoryData['products']['product'])) {
        foreach ($inventoryData['products']['product'] as $product) {
            $name = $product['Name'];
            $category = $product['Category'];
            $subcategory = $product['Subcategory'];
            $price = $product['price'];
            $image = $product['Image'];
            $quantity = $product['Quantity'];

            $sql = "INSERT INTO inventory (`name`, `category`, `subcategory`, `Unit_price`, `image`, `quantity`) 
                    VALUES (:name, :category, :subcategory, :price, :image, :quantity)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':subcategory', $subcategory);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':quantity', $quantity);

            $stmt->execute();
            //echo "Record inserted successfully from JSON<br>";
        }
    } else {
        echo "No product data found in the JSON file";
    }
	
	header("Location: admin.php");
    exit();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

