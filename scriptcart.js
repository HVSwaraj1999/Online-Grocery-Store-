'use strict';

function refreshTime() {
    const timeDisplay = document.getElementById("time");
    const dateString = new Date().toLocaleString();
    const formattedString = dateString.replace(", ", " - ");
    timeDisplay.textContent = formattedString;
}

setInterval(refreshTime, 50);
let totalPrice = 0;
$(document).ready(function () {
    getCartData();
});

function getCartData() {
    $.ajax({
        url: 'cart_backend.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var cartItems = $('#cart-items');
            cartItems.empty();
			
			totalPrice = 0;

            data.forEach(function (item) {
                cartItems.append(
                    '<div class="cart-item">' +
                    '<p>Item ID: ' + item.ItemID + '</p>' +
                    '<p>Item Name: ' + item.ItemName + '</p>' +
                    '<p>Category: ' + item.Category + '</p>' +
                    '<p>Subcategory: ' + item.SubCategory + '</p>' +
                    '<p>Amount: ' + item.Unit_price + '</p>' +
                    '<p>Quantity: ' + item.Quantity + '</p>' +
                    '<p>Price: $' + item.Quantity*item.Unit_price + '</p>' +
                    '<p>Transaction ID: ' + item['Transaction ID'] + '</p>' +
                    '</div>'
                );
				 totalPrice += parseFloat(item.Unit_price) * parseInt(item.Quantity);
				 //alert(totalPrice);
            });
			$('#total-price').text('$' + totalPrice.toFixed(2));
        },
        error: function (xhr, status, error) {
            console.error('Error fetching cart data:', status, error);

            // Display an error message on the UI
            $('#cart-items').html('<p>Error fetching cart data. Please try again later.</p>');
        }
    });
}


function shopItems() {
    $.ajax({
        url: 'cart_shopItems.php',
        type: 'GET',
        dataType: 'json',
        success: function () {
            if (response.status === 'success') {
                // Handle success, maybe show a success message
                getCartData(); // Refresh cart data
            } else {
                console.error('Error updating transaction status:', response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error updating transaction status:', status, error);
            // Display an error message on the UI
           // $('#cart-items').html('<p>Error updating transaction status. Please try again later.</p>');
        }
    });
}


function cancelShopping() {
    $.ajax({
        url: 'cart_CancelItems.php',
        type: 'GET',
        dataType: 'json',
        success: function () {
            if (response.status === 'success') {
                // Handle success, maybe show a success message
                getCartData(); // Refresh cart data
            } else {
                console.error('Error updating transaction status:', response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error updating transaction status:', status, error);
            // Display an error message on the UI
           // $('#cart-items').html('<p>Error updating transaction status. Please try again later.</p>');
        }
    });
	$.ajax({
        url: 'process.php',
        type: 'GET',
        dataType: 'json',
        success: function () {
            if (response.status === 'success') {
                // Handle success, maybe show a success message
                getCartData(); // Refresh cart data
            } else {
                console.error('Error updating transaction status:', response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error updating transaction status:', status, error);
            // Display an error message on the UI
           // $('#cart-items').html('<p>Error updating transaction status. Please try again later.</p>');
        }
    });
}
