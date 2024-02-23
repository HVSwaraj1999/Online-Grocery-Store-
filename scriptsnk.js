'use strict';

function refreshTime() {
    const timeDisplay = document.getElementById("time");
    const dateString = new Date().toLocaleString();
    const formattedString = dateString.replace(", ", " - ");
    timeDisplay.textContent = formattedString;
}

setInterval(refreshTime, 50);

$(document).ready(function () {
    // Move these lines inside the document.ready function to get the updated userInput
    var snacksNameInput = $('#snacksName');
    var lettersOnly = /^[A-Za-z]+$/;

    $('#snacksForm').submit(function (event) {
        event.preventDefault();

        var userInput = snacksNameInput.val();

        if (!lettersOnly.test(userInput)) {
            alert('Please enter a valid snacks name (letters only).');
            return false;
        }

        $.ajax({
            url: 'get_inventorysnk.php',
            type: 'GET',
            dataType: 'json',
            data: { snackName: userInput },
            success: function (data) {
                var productList = $('#productList');
                productList.empty();

                data.forEach(function (product) {
                    productList.append(
                        '<div class="flip-card">' +
                        '<div class="flip-card-inner">' +
                        '<div class="flip-card-front">' +
                        '<img src="' + product.Image + '" alt="' + product.Name + '">' +
                        '</div>' +
                        '<div class="flip-card-back">' +
                        '<p>' + product.Name + '<br>Price: $' + product['Unit_price'] + '</p>' +
                        '<input type="number" id="quantity_' + product['Item number'] + '" placeholder="Quantity" min="1" max="' + product.Quantity + '">' +
                        '<button class="add-to-cart" data-product-id="' + product['Item number'] + '"  data-product-stock="' + product.Quantity + '"  data-product-name="' + product.Name + '" data-product-price="' + product[`Unit_price`] + '">Add to Cart</button>' +
                        '</div>' +
                        '<div class="quantity-display">Quantity: <span id="quantity_display_' + product['Item number'] + '">0</span></div>' + // Display quantity in the flip card
                        '</div>' +
                        '</div>'
                    );
                });

                $('.add-to-cart').click(function () {
                    var productId = $(this).data('product-id');
                    var productstock = $(this).data('product-stock');
                    var productname = $(this).data('product-name');
                    var productprice = $(this).data('product-price');
                    var selectedQuantity = parseInt($('#quantity_' + productId).val());

                    if (selectedQuantity > 0 && selectedQuantity <= productstock) {
                        addToCart(productId, -selectedQuantity, productprice);
                       // displayProductsone();
                        $('#quantity_display_' + productId).text(selectedQuantity); // Update displayed quantity
                    } else {
                        alert('Please enter a valid quantity for Product ID: ' + productId + ' - ' + productname);
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching products:', status, error);
            }
        });
    });

    function addToCart(productId, newQuantity, price) {
        // Make an AJAX request to process_update.php
        $.ajax({
            url: 'process_update.php',
            type: 'POST',
            data: {
                itemNumber: productId,
                quantityIncrease: newQuantity
            },
            success: function (response) {
                // Handle the response from the server
               // console.log('Update successful:', response);

                // Optionally, you can update the UI or perform other actions
                //alert(productName + ' added to cart with quantity ' + newQuantity);
            },
            error: function (xhr, status, error) {
                console.error('Error updating cart:', error);
            }
        });
		$.ajax({
        type: 'POST',
        url: 'addToCart.php',
        data: { productId: productId, quantity: -newQuantity, cost: price},
        success: function(response) {
            alert('Item added to cart successfully!');
        },
        error: function(error) {
            console.error('Error adding item to cart:', error);
        }
    });
	}
});
