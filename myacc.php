<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mystyle.css">
    <title>Online Grocery Store</title>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script>
        $(document).ready(function(){
            $('#accountForm').submit(function(e){
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'account_handler.php',
                    data: $(this).serialize(),
                    success: function(response){
                        $('#result-container').html(response);
                    }
                });
            });
        });
    </script>
</head>
<body>

    <header>
	<p class = "bl">First Name - HARI VENKATA SWARAJ <br> Last Name - KOTHURI <br> nid - hxk22018<br> Course Name - Web Programming Language <br> Section NO-001</p>
    
		<h2>Online Grocery Store</h2>
		<br>
        <nav>
            <ul>
				<li><a href="fp.php">Fresh products</a></li>
                <li><a href="fro.php">Frozen</a></li>
                <li><a href="pan.php">Pantry</a></li>
                <li><a href="bac.php">Breakfast and Cereal</a></li>
                <li><a href="bak.php">Baking</a></li>
                <li><a href="snk.php">Snacks</a></li>
                <li><a href="can.php">Candy</a></li>
                <li><a href="sps.php">Specialty shops</a></li>
                <li><a href="deal.php">Deals</a></li>
                <li><a href="myacc.php">My-account</a></li>
                <li><a href="abus.php"> About-us</a></li>
                <li><a href="conus.php">Contact-us</a></li>
				<li><a href="cart.php">Cart</a></li>
            </ul>
        </nav>
    </header>
    <main>
	<form id="logoutForm" action="logout.php" method="post" class="logout-button">
			<input type="submit" value="Logout">
	</form>
	<div class="container">
        <div class="sidebar">
			<aside>
				<img src="Pics\myaccount.jpg" alt="Side Image">
			</aside>

		</div>
		<div class="main-content">
			<h1>My Account</h1>
			
			<div class="forms-container">
				<form id="accountForm" method="post">
					<!-- Existing form fields -->
		
					<p>View Transactions:</p>
					<label for="viewTransactions">Select View:</label>
					<select id="viewTransactions" name="viewTransactions">
						<option value="all">All Transactions</option>
						<option value="month">Transactions This Month</option>
						<option value="last3months">Transactions Last 3 Months</option>
						<option value="year">Transactions This Year</option>
					</select>
            
					<input type="submit" value="Submit">
				</form>
				<div id="result-container"></div>
		
				<form id="cart_CancelItems" action="cart_CancelItems.php" method="post">
					<br><br>
					<p>Cancel Transactions:</p>
					<label for="cancelTransactionID">Transaction ID to Cancel:</label>
					<input type="text" id="cancelTransactionID" name="cancelTransactionID" placeholder="Enter Transaction ID">        
					<input type="submit" value="Submit">
				</form>
			</div>
		</div>
	
	</div>
    </main>
    <footer>
        <p>Done by Hari venkata swaraj Kothuri ------ <span id="time" align="right"> </span></p>
    </footer>
	<script src="script.js"></script>
</body>
</html>
