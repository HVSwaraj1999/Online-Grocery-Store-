<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_grocery_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$snackName = isset($_GET['snackName']) ? $_GET['snackName'] : '';

// Use prepared statements to prevent SQL injection
$stmt = null;
$data = [];

if ($snackName !== '') {
    $stmt = $conn->prepare("SELECT * FROM inventory WHERE `Name` = ? AND Category = 'Snacks'");
    $stmt->bind_param("s", $snackName);
} else {
    $stmt = $conn->prepare("SELECT * FROM inventory WHERE Category = 'Snacks'");
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
