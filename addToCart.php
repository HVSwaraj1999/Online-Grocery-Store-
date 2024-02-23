<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "online_grocery_store";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have a way to get user_id, replace this with your authentication/session logic
$present_user_result = $conn->query("SELECT `Customer ID` FROM present_user_id");
if ($present_user_result->num_rows > 0) {
    $user_row = $present_user_result->fetch_assoc();
    $user_id = $user_row['Customer ID'];
} else {
    // Handle the case where there's no user_id in present_user_id
    die("Error: No user_id found in present_user_id");
}

// Check if the user already has items in the cart
$cart_result = $conn->query("SELECT * FROM carts WHERE `Customer ID` = $user_id AND `Cart status` ='IN_CART' ");

if ($cart_result->num_rows > 0) {
    // If the cart is not empty, get the existing transaction ID
    $cart_row = $cart_result->fetch_assoc();
    $transaction_id = $cart_row['Transaction ID'];
} else {
    // If the cart is empty, create a new transaction ID
    $stmt = $conn->prepare("INSERT INTO transactions (`Transaction Status`, `Transaction Date`, `Total Price`) VALUES (?, NOW(), 0.0)");
    $stmt->bind_param("s", $status);
    
    // Set initial status to 'Pending'
    $status = 'IN_CART';
    
    $stmt->execute();
    $transaction_id = $conn->insert_id;
    $stmt->close();
}

// Get data from the AJAX request
$productId = isset($_POST['productId']) ? intval($_POST['productId']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
$cost = isset($_POST['cost']) ? floatval($_POST['cost']) : 0;
echo $cost;
// Check if the item is already in the cart
$stmt = $conn->prepare("SELECT * FROM carts WHERE `Customer ID` = ? AND `Item number` = ? AND `Cart status` ='IN_CART'");
$stmt->bind_param("ii", $user_id, $productId);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    // If the item is in the cart, update the quantity
    $row = $result->fetch_assoc();
    $newQuantity = $row['Quantity'] + $quantity;
    
    $stmt = $conn->prepare("UPDATE carts SET Quantity = ? WHERE `Customer ID` = ? AND `Item number` = ?");
    $stmt->bind_param("iii", $newQuantity, $user_id, $productId);
    $stmt->execute();
    $stmt->close();
	
	$stmt = $conn->prepare("UPDATE transactions SET `Total Price` = `Total Price` + (? * ?) WHERE `Transaction ID`= ?");
	$stmt->bind_param("dii", $cost, $quantity, $transaction_id);
	$stmt->execute();
	
	if ($stmt->errno) {
		echo "Error updating transactions table: " . $stmt->error;
	}
	
	$stmt->close();
	//echo "Total Price";
	
} else {
    // If the item is not in the cart, insert a new record with the transaction_id
    $stmt = $conn->prepare("INSERT INTO carts (`Customer ID`, `Item number`, `Quantity`, `Transaction ID`, `Cart status`) VALUES (?, ?, ?, ?, 'IN_CART')");
    $stmt->bind_param("iiii", $user_id, $productId, $quantity, $transaction_id);
    $stmt->execute();
    $stmt->close();
	
	$stmt = $conn->prepare("UPDATE transactions SET `Total Price` = `Total Price` + (? * ?) WHERE `Transaction ID`= ?");
	$stmt->bind_param("dii", $cost, $quantity, $transaction_id);
	$stmt->execute();
	
	if ($stmt->errno) {
		echo "Error updating transactions table: " . $stmt->error;
	}
	
	$stmt->close();
		
}

$conn->close();
?>
