<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mystyle.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="scriptpan.js"></script>
    <title>Online Grocery Store</title>
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
		<br>
		<aside>
            <img src="Pics\Pantry\Pantry.jpg" alt="Side Image">
        </aside>
		<br>

		</div>
		<div class="main-content">
            <h2>Pantry</h2>
            <h2>Categories:</h2>            
			
			<label for="categorySelect">Select Category:</label>
			<select id="categorySelect">
					<option value="Shop All">Shop All</option>
					<option value="cannedgoods">Canned goods</option>
					<option value="cannedvegetable">Canned Vegetable</option>
					<option value="condiments">Condiments</option>
					<option value="peanutbutter-spread">Peanut Butter and Spread</option>
					<option value="pasta-pizza">Pasta and Pizza</option>
					<option value="rollbacks">Rollbacks</option>	
			</select>
			<br><br><br><br><br><br>
			<h2>Items:</h2>
			<br>
			<div id="productList" class="grid-container">
               
            </div>
		</div>	
	</div>

    </main>
    <footer>
        <p>Done by Hari venkata swaraj Kothuri ------ <span id="time" align="right"> </span></p>
    </footer>

</body>
</html>
