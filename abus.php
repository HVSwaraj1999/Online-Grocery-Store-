<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mystyle.css">
    <title>Online Grocery Store</title>
</head>
<body>

    <header>
	<p class = "bl">First Name - HARI VENKATA SWARAJ <br> Last Name - KOTHURI <br> nid - hxk22018<br> Course Name - Web Programming Language <br> Section NO-001</p>
    
        <h1>Online Grocery Store</h1>
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
				<img src="Pics\aboutus.jpg" alt="Side Image">
			</aside>

		</div>
		<div class="main-content">
            
			<strong><h2>About-Us</h2>
			<p class="bold">Hari Venkata Swaraj Kothuri</p>
			<p class="bold">hxk220018@utdallas.edu</p>
			<p class="bold">+1-(945)-2*4-6**0</p>
			</strong>
			
        </div>
	</div>
    </main>
	<br><br><br><br><br><br>
    <footer>
        <p>Done by Hari venkata swaraj Kothuri ------ <span id="time" align="right"> </span></p>
    </footer>
	<script src="script.js"></script>
</body>
</html>
