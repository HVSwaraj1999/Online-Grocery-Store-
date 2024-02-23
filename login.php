<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "online_grocery_store";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
	
	$conn->query("DELETE FROM present_user_id");
	

    // Perform SQL query
    $sql = "SELECT * FROM users WHERE User_Name = '$username' AND Password = '$password'";
    $result = $conn->query($sql);
	
	if ($username == 'admin' && $password == 'admin') {
        header("Location: admin.php");
        exit();
    } elseif ($result->num_rows > 0) {
		$userRow = $result->fetch_assoc();
        $customerID = $userRow['Customer ID'];

        // Insert Customer ID into present_user_id table
        $stmt = $conn->prepare("INSERT INTO present_user_id (`Customer ID`) VALUES (?)");
        $stmt->bind_param("i", $customerID);  // Assuming Customer ID is an integer
        $stmt->execute();
        $stmt->close();
        // Login successful  		
		header("Location: fp.php");
        exit();
    } else {
        // Login failed
        echo "Invalid username or password.";
		//echo $hashed_password;
    }
}

// Close connection
$conn->close();
?>
