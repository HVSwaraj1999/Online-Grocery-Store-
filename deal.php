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
            <img src="Pics\Deals.jpg" alt="Side Image">
        </aside>

		</div>
		<div class="main-content">
            <h1>Deals Of The Week</h1>
            <table style="width:100%">
				<tr>
				<th>Day</th>
				<th>Meal</th>
				<th>Discount</th>
			</tr>
			<tr>
				<td>Monday</td>
				<td>Lunch</td>
				<td>10% OFF</td>
			</tr>
			<tr>
				<td>Tuesday</td>
				<td>Dinner</td>
				<td>10% OFF</td>
			</tr>
			<tr>
				<td>Wednesday</td>
				<td>Lunch</td>
				<td>15% OFF</td>
			</tr>
			<tr>
				<td>Thursday</td>
				<td>Breakfast</td>
				<td>20% OFF</td>
			</tr>
			<tr>
				<td>Friday</td>
				<td>Lunch</td>
				<td>50% OFF</td>
			</tr>
			</table>
        </div>
	</div>
    </main>
    <footer>
        <p>Done by Hari venkata swaraj Kothuri ------ <span id="time" align="right"> </span></p>
    </footer>
	<script src="script.js"></script>
</body>
</html>
