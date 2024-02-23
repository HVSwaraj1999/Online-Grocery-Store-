<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_grocery_store"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql ="UPDATE transactions SET `Transaction Status` = 'SHOPPING_DONE' WHERE `Transaction Status` = 'IN_CART' AND `Transaction ID` IN (SELECT DISTINCT `Transaction ID` FROM carts WHERE `Cart status`= 'IN_CART') ";
$result = $conn->query($sql);

    if ($result === true) {
        // Clear the cart
        $clearCart = "UPDATE carts SET `Cart status`= 'SHOPPING_DONE' WHERE `Cart status`= 'IN_CART'";
        $resultClearCart = $conn->query($clearCart);

        if ($resultClearCart === true) {
            echo json_encode(['status' => 'success', 'message' => 'Shopping DONE']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error clearing cart: ' . $conn->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating transaction status: ' . $conn->error]);
    }
$data = array();
$conn->close();
header('Content-Type: application/json');
echo json_encode($data);
?>
