<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_grocery_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$candyName = isset($_GET['candyName']) ? $_GET['candyName'] : '';

// Use prepared statements to prevent SQL injection
$stmt = null;
$data = [];

if ($candyName !== '') {
    $stmt = $conn->prepare("SELECT * FROM inventory WHERE `Name` = ? AND Category = 'Candy'");
    $stmt->bind_param("s", $candyName);
} else {
    $stmt = $conn->prepare("SELECT * FROM inventory WHERE Category = 'Candy'");
}

if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

echo json_encode($data);

$conn->close();
?>
