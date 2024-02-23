<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Customer Registration</h2>
        <form action="registercheck.php" method="post">
            <label for="username">User Name:</label>
            <input type="text" name="username" class="form-control" required>

            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" class="form-control" required>

            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" class="form-control" required>

            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" class="form-control" required>

            <label for="dob">Date of Birth (MM/DD/YYYY):</label>
            <input type="text" name="dob" pattern="\d{2}/\d{2}/\d{4}" class="form-control" required>
			
			<label for="pn">Phone number:</label>
            <input type="text" name="pn" class="form-control" required>

            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>

            <label for="address">Address:</label>
            <textarea name="address" class="form-control" required></textarea>

            <button type="submit" class="btn btn-success mt-3">Register</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
