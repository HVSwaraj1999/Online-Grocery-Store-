<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $dob = $_POST["dob"];
    $pn = $_POST["pn"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    // Validation
    if ($password != $confirm_password) {
        echo 'Passwords do not match';
    } elseif (strlen($password) < 8) {
        echo 'Password must be at least 8 characters';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || strpos($email, '@') === false || strpos($email, '.com') === false) {
        echo 'Invalid email address';
    } else {
        // Hash the password before storing
//$hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $dob_timestamp = strtotime($dob);
        $current_timestamp = time();
        $age = date('Y', $current_timestamp) - date('Y', $dob_timestamp);

        // Insert data into the database for customers
        $stmt = $conn->prepare("INSERT INTO customers (`First Name`, `Last Name`, `Age`, `Phone number`, `email`, `Address`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $firstname, $lastname, $age, $pn, $email, $address);

        if ($stmt->execute()) {
            // Retrieve the generated customer IDx
            $customer_id = $stmt->insert_id;

            // Insert data into the database for users using the customer ID
            $stmt = $conn->prepare("INSERT INTO users (`Customer ID`, `User_Name`, `Password`) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $customer_id, $username, $password);

            if ($stmt->execute()) {
                echo 'Registration successful You can now <a href="index.php">login</a>.';
				//<p class="mt-3">Don't have an account? <a href="register.php">Register</a></p>;
            } else {
                echo 'Error during user registration: ' . $stmt->error;
            }
        } else {
            echo 'Error during customer registration: ' . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
