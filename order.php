<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="cartstyles.css">
	<link rel="javascript" href="script.js">
</head>
<body>

    <!-- Navigation (Optional) -->
    <nav class="navbar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="product.php">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
			<li><a href="order.php">Order</a></li>
            <li><a href="aboutUs.php">About Us</a></li>
			<li><a href="signUp.php">Sign Up</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="profile.php">Profile</a></li>
        </ul>
    </nav><!-- Cart Page HTML Structure -->
	
<!-- Cart Page Table Structure -->
<table id="cartTable">
  
  <thead>
    <tr>
      <th>Product Name</th>
      <th>Price</th>
	  <th>Quantity</th>
      <th>Subtotal</th>
      <th>Action</th>
    </tr>
  </thead>
  
  <tbody id="order">
    <!-- Products will be dynamically added here -->
 </tbody>
  
</table>

<div class="cart-summary">
  <strong>Total Amount: $<span id="totalAmount">0.00</span></strong>

    <script>
        // Function to populate the cart table
        function populateOrder() {
            let orderBody = document.getElementById("order");
            let order = JSON.parse(localStorage.getItem("order")) || [];

            orderBody.innerHTML = ""; // Clear the table body

            if (order.length === 0) {
                orderBody.innerHTML = `<tr><td colspan="5">Your cart is empty.</td></tr>`;
            } else {
                order.forEach((product, index) => {
                    let subtotal = (product.price * product.quantity).toFixed(2);
                    let row = document.createElement("tr");

                    row.innerHTML = `
                        <td>${product.name}</td>
                        <td>$${product.price.toFixed(2)}</td>
                        <td>
                            <input type="number" value="${product.quantity}" min="1" 
                                   onchange="updateQuantity(${index}, this.value)">
                        </td>
                        <td>$${subtotal}</td>
                        <td><button onclick="removeProduct(${index})">Remove</button></td>
                    `;

                    orderBody.appendChild(row);
                });
            }

            // Update total amount after populating the cart
            updateTotalAmount();
        }

        // Function to update the total amount in the cart summary
        function updateTotalAmount() {
            let order = JSON.parse(localStorage.getItem("order")) || [];

            // Calculate total amount
            let totalAmount = order.reduce((total, product) => {
                return total + (product.price * product.quantity);
            }, 0);

            // Update total amount displayed
            document.getElementById("totalAmount").textContent = totalAmount.toFixed(2);
        }

        // Function to update product quantity
        function updateQuantity(index, newQuantity) {
            let order = JSON.parse(localStorage.getItem("order")) || [];
            if (newQuantity < 1) {
                newQuantity = 1; // Ensure minimum quantity is 1
            }
            order[index].quantity = parseInt(newQuantity);
            localStorage.setItem("order", JSON.stringify(order));
            populateOrder(); // Re-render the table and update total amount
        }

        // Function to remove a product from the cart
        function removeProduct(index) {
            let order = JSON.parse(localStorage.getItem("order")) || [];
            order.splice(index, 1); // Remove the product at the given index
            localStorage.setItem("order", JSON.stringify(order));
            populateOrder(); // Re-render the table and update total amount
        }

        // Populate the cart table on page load
        document.addEventListener("DOMContentLoaded", populateOrder);
    </script>

</body>
</html>
