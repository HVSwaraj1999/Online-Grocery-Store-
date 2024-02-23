`use strict`;
function refreshTime() {
  const timeDisplay = document.getElementById("time");
  const dateString = new Date().toLocaleString();
  const formattedString = dateString.replace(", ", " - ");
  timeDisplay.textContent = formattedString;
}
setInterval(refreshTime, 50);


$(document).ready(function () {
    // When the page is ready, make an AJAX request to get products from the server
    $.ajax({
        url: 'get_inventorybac.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Process the retrieved data and populate the product list
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
                    '<button class="add-to-cart" data-product-id="' + product['Item number'] +  '"  data-product-stock= "' + product.Quantity +  '"  data-product-name="' + product.Name +  '" data-product-price="' + product[`Unit_price`] +  '">Add to Cart</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );
            });
			
			
			let currentCategory = $("#categorySelect").val();

			// Handle category filter change
			$("#categorySelect").on("change", function () {
				var newCategory = $(this).val();
				if (newCategory !== currentCategory) {
					console.log("Changing category to:", newCategory);
					currentCategory = newCategory;
					displayProductsone();
					//alert(newCategory);
				}
			});




            // Add a click event listener to the "Add to Cart" buttons
             $('.add-to-cart').click(function () {
				var productId = $(this).data('product-id');
				var productname = $(this).data('product-name');
				var productstock = $(this).data('product-stock');
				var productprice = $(this).data('product-price');
			
				if (productstock > 0) {
					//productstock--;
				addToCart(productId, -1,productprice);
				// Fetch updated inventory and refresh product list
				displayProductsone();
				} else {
				alert('Product  Product ID: ' + productId + '  Name :' + productname + ' is out of stock');
				}
			});
			
			
        },
        error: function (xhr, status, error) {
            console.error('Error fetching products:', status, error);
        }
    });
	function displayProductsone(){
		$.ajax({
        url: 'get_inventorybac.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Process the retrieved data and populate the product list
            var productList = $('#productList');
            productList.empty();
			//alert(product.Subcategory);
            // Loop through the products and append them to the product list as flip cards
			let currentCategory = $("#categorySelect").val();
            data.forEach(function (product) {
			if (currentCategory === "Shop All" || currentCategory === product.Subcategory) {
                productList.append(
                    '<div class="flip-card">' +
                    '<div class="flip-card-inner">' +
                    '<div class="flip-card-front">' +
                    '<img src="' + product.Image + '" alt="' + product.Name + '">' +
                    '</div>' +
                    '<div class="flip-card-back">' +
                    '<p>' + product.Name + '<br>Price: $' + product['Unit_price'] + '</p>' +
                    '<button class="add-to-cart" data-product-id="' + product['Item number'] +  '"  data-product-stock="' + product.Quantity +  '"  data-product-name="' + product.Name +  '" data-product-price="' + product[`Unit_price`] +  '">Add to Cart</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );
			}
            });
			

            // Add a click event listener to the "Add to Cart" buttons
            $('#productList').on('click', '.add-to-cart', function () {
				var productId = $(this).data('product-id');
				var productname = $(this).data('product-name');
				var productstock = $(this).data('product-stock');
				var productprice = $(this).data('product-price');
			
				if (productstock > 0) {
					//productstock--;
				addToCart(productId, -1,productprice);
				// Fetch updated inventory and refresh product list
				//displayProductsone();
				} else {
				alert('Product  Product ID: ' + productId + '  Name :' + productname + ' is out of stock');
				}
			});
			
			
        },
        error: function (xhr, status, error) {
            console.error('Error fetching products:', status, error);
        }
    });
		
		
	}

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
