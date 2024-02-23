<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Price</title>
    <!-- Add Bootstrap CDN link for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Update Price</h1>

        <form action="process_updateprice.php" method="post">
            <div class="form-group">
                <label for="itemNumber">Select Item:</label>
                <select class="form-control" id="itemNumber" name="itemNumber">
                    <?php
                    // Add your database connection details
                    $servername = "localhost";
					$username = "root";  // Default username for XAMPP
					$password = "";      // Default password for XAMPP
					$dbname = "online_grocery_store";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Fetch item numbers and names from the inventory table
                        $sql = "SELECT `Item number`, `Name` FROM inventory";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        // Populate the dropdown options
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"{$row['Item number']}\">{$row['Item number']} - {$row['Name']}</option>";
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    ?>
                </select>
            </div>
			
			 <div class="form-group">
                <label for="priceIncrease">Enter Price:</label>
                <input type="text" class="form-control" id="priceIncrease" name="priceIncrease" placeholder="Enter price Increase">
            </div>

            <!-- Add additional form fields for updating data if needed -->
            <button type="submit" class="btn btn-success">Update Price</button>
        </form>
    </div>

    <!-- Add Bootstrap JS and Popper.js CDN links for Bootstrap functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
