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
				<img src="Pics\contactus.jpg" alt="Side Image">
			</aside>

		</div>
		<div class="main-content" onsubmit=" return myFunction()">
            <form>
				<label for="fname">First name:</label><br>
				<input type="text" id="fname" name="fname" required><br>
				<label for="lname">Last name:</label><br>
				<input type="text" id="lname" name="lname" required><br>
				<label for="phno">Phone Number:  (ddd) ddd- dddd</label><br>
				<input type="text" id="phno" name="phno" required><br>
				<p>Gender</p>
				<input type="radio" id="Male" name="Gender" value="Male" required>
			    <label for="Male">Male</label>
			    <input type="radio" id="Female" name="Gender" value="Female" required>
			    <label for="Female">Female</label><br><br>
				<label for="Mail">Email Address:</label>
				<input type="email" id="Mail" name="Mail" required>
				<br><br>
				<label for="comment">Comment:</label>
				<textarea id="comment" name="comment" required></textarea><br>

				<p><em>Agree to terms and conditions</em></p>
				<select id="tac" name="tac">
					<option value="ys">YES</option>
					<option value="no">NO</option>
				</select>
				<br><br>
				<input type="submit" value="Submit">
			</form>
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
