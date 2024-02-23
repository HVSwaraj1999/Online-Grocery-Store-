<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <!-- Add Bootstrap CDN link for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Admin Page</h1>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Load Data</h2>
                <form action="process.php" method="post">
                    <input type="hidden" name="action" value="loadData">
                    <button type="submit" class="btn btn-primary">Load Data</button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h2 class="card-title">Update Quantity</h2>
                <form action="updata.php" method="post">
                    <input type="hidden" name="action" value="updateData">
                    <!-- Add additional form fields for updating data if needed -->
                    <button type="submit" class="btn btn-success">Update Quantity</button>
                </form>
            </div>
        </div>
		
		<div class="card mt-3">
            <div class="card-body">
                <h2 class="card-title">Update Price</h2>
                <form action="updataprice.php" method="post">
                    <input type="hidden" name="action" value="updateData">
                    <!-- Add additional form fields for updating data if needed -->
                    <button type="submit" class="btn btn-success">Update Price</button>
                </form>
            </div>
        </div>
		
		<div class="card mt-3">
            <div class="card-body">
                <h2 class="card-title">View Inventory Table</h2>
                <!-- Add code to fetch and display content from the inventory table -->
				<form action="viewinventory.php" method="post">
                    <input type="hidden" name="action" value="showinventory">
                    <!-- Add additional form fields for updating data if needed -->
                    <button type="submit" class="btn btn-success">Show Inventory</button>
                </form>
            </div>
        </div>
			
		<div class="card mt-3">
            <div class="card-body">
                <h2 class="card-title">Low Inventory Items</h2>
                <!-- Add code to fetch and display low inventory items -->
				<form action="lowinventory.php" method="post">
                    <input type="hidden" name="action" value="showinventory">
                    <!-- Add additional form fields for updating data if needed -->
                    <button type="submit" class="btn btn-success">Show Inventory</button>
                </form>
			</div>			
		</div>
		
		<div class="card mt-3">
			<div class="card-body">
				<h2 class="card-title">Customers with More than 2 Transactions</h2>
				<form action="admin_handler.php" method="post">
					<input type="hidden" name="action" value="customerTransactions">
					<label for="transactionDate">Enter Date:</label>
					<input type="date" id="transactionDate" name="transactionDate" required>
					<button type="submit" class="btn btn-info">Show Customers</button>
				</form>
			</div>
		</div>
		

		<div class="card mt-3">
            <div class="card-body">
                <h2 class="card-title">Customer Transactions by Zip Code and Month</h2>
                <form action="customerTransactionsForm.php" method="post">
                    <input type="hidden" name="action" value="customerTransactionsByZipAndMonth">

                    <label for="zipCode">Enter Zip Code:</label>
                    <input type="text" id="zipCode" name="zipCode" required>

                    <label for="selectedMonth">Select Month:</label>
                    <select id="selectedMonth" name="selectedMonth" required>
                        <!-- Add options for months as needed -->
                        <option value="1">January</option>
                        <option value="2">February</option>
						<option value="3">March</option>
                        <option value="4">April</option>
						<option value="5">May</option>
                        <option value="6">June</option>
						<option value="7">July</option>
                        <option value="8">August</option>
						<option value="9">September</option>
						<option value="10">October</option>
                        <option value="11">November</option>
						<option value="12">December</option>
                    </select>

                    <button type="submit" class="btn btn-info">Get Transactions</button>
                </form>
            </div>
        </div>
		
		
		<div class="card mt-3">
			<div class="card-body">
				<h2 class="card-title">Customers with More than 3 Transactions AND age more than 20</h2>
				<form action="t3a20.php" method="post">
					<input type="hidden" name="action" value="t3a20">
					<button type="submit" class="btn btn-info">Show Customers</button>
				</form>
			</div>
		</div>
		
		
		<div class="card mt-3">
			<div class="card-body">
				<h2 class="card-title">Logout</h2>
				<form action="logout.php" method="post">
					<button type="submit" class="btn btn-danger">Logout</button>
				</form>
			</div>
		</div>
    </div>
	

    <!-- Add Bootstrap JS and Popper.js CDN links for Bootstrap functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
