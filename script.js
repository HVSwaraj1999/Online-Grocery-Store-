`use strict`;
function refreshTime() {
  const timeDisplay = document.getElementById("time");
  const dateString = new Date().toLocaleString();
  const formattedString = dateString.replace(", ", " - ");
  timeDisplay.textContent = formattedString;
}
setInterval(refreshTime, 50);


function myFunction() {
		var fnameIn = document.getElementById("fname").value;
		var lnameIn = document.getElementById("lname").value;
		var phnoIn = document.getElementById("phno").value;
        var MailIn = document.getElementById("Mail").value;
		var comment = document.getElementById("comment").value;

		
		var NamePattern = /^[A-Z][a-zA-Z]*$/;
        var MailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		var PhonePattern = /^\(\d{3}\) \d{3}-\d{4}$/;
        if (!NamePattern.test(fnameIn) || !NamePattern.test(lnameIn)) {
			alert("Name should only contain alphabetic and start with a capital letter.");
			return;
        }
		if (fnameIn == lnameIn) {
			alert("First name and last name cannot be the same.");
			return;
        }
		if (!PhonePattern.test(phnoIn)) {
			alert("Phone number must be formatted as (ddd) ddd-dddd.");
			return;
        }
		if (!MailPattern.test(MailIn)) {
            alert("Email address must contain @ and .");
            return;
        }
		if (comment.length < 10) {
                alert("Comment must be at least 10 characters.");
                return false;
        }
        alert("Inputs are valid!");
}



function filterItemsbac(category) {
            var items = document.querySelectorAll('.flip-card');
			for (var i = 0; i < items.length; i++) {
                var item = items[i];
                var itemCategory = item.getAttribute('data-category');
                if (category === 'Shop All' || category === itemCategory) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            }
}


function populateCart() {
    const cartItems = document.getElementById("cart-items");
    const totalPrice = document.getElementById("total-price");

    const cartData = JSON.parse(localStorage.getItem('cart')) || [];

    let cartHTML = "";
    let total = 0;

    for (const item of cartData) {
        const itemPrice = item.price * item.quantity;
        total += itemPrice;
        cartHTML += `
            <div class="cart-item">
                <p>Name: ${item.name}</p>
                <p>Quantity: ${item.quantity.toFixed(2)}</p>                
                <p>Price: $${item.price.toFixed(2)}</p>
                <p>Item Total: $${itemPrice.toFixed(2)}</p>
            </div>
        `;
    }

    cartItems.innerHTML = cartHTML;
    totalPrice.textContent = `Total Price: $${total.toFixed(2)}`;
}

function buyItems() {
    const cartData = JSON.parse(localStorage.getItem('cart')) || [];

    if (cartData.length === 0) {
        alert("Your cart is empty. There's nothing to buy.");
        return;
    }

    alert("Thank you for your purchase!");

    // Update XML/JSON files here (call a function or make an API request)

    localStorage.removeItem('cart');
	
	addToExistingCartJson(cartItems);
    populateCart(); // Update the cart display
}

function cancelShopping() {
    const cancel = confirm("Are you sure you want to cancel shopping?");
    if (cancel) {
		const cartData = JSON.parse(localStorage.getItem('cart')) || [];
        localStorage.removeItem('cart');
		addToExistingCartJson(cartItems);
        // Update XML/JSON files here (call a function or make an API request)
        location.reload();
    }
}

// Example usage:
// Call populateCart() when the page loads to display the cart items
populateCart();

// Use buyItems() when the user decides to buy the items
// Use cancelShopping() when the user cancels shopping



function addToExistingCartJson(cartItems) {
  $.ajax({
    type: "POST",
    url: "updateCart.php", // Replace with the actual path to your PHP script
    data: JSON.stringify(cartItems),
    contentType: "application/json",
    success: function (response) {
      console.log("Update successful:", response);
    },
    error: function (xhr, status, error) {
      console.error("Error updating cart:", error);
    }
  });
}