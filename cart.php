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

  <tbody id="cartBody">
    <!-- Products will be dynamically added here -->
 </tbody>
  
</table>

<div class="cart-summary">
  <strong>Total Amount: $<span id="totalAmount">0.00</span></strong>
  <button class="proceedToPay" onclick="showModal('modal1')">Proceed to Pay</button>
  
  <!-- Modal Section -->
  <div id="modal1" class="modal" style="display: none;">
  <div class="modal-content">
    <span class="close" onclick="closeModal('modal1')">&times;</span>

<div class="qr-section">
  <div class="qr-container">
    <h3>TNG</h3>
    <img src="WhatsApp Image 2024-11-17 at 19.08.23.jpeg" alt="TNG QR Code">
  </div>
  <div class="qr-container">
    <h3>MAYBANK</h3>
    <img src="qr.png"alt="Maybank QR Code">
  </div>
  <div class="qr-container">
    <h3>PUBLIC BANK</h3>
    <img src="636259-small.png" alt="Public Bank QR Code">
  </div>
</div>



<div class = "payment_receipt">
<div class= "receipt">
<h1>Add Receipt</h1>
<p>take a screenshot of your payment</p>
 <p>and please add it here</p>
<img src= "receipt.png" id="receipt-pic">
<label for="input-file">Update image</label>
<input type="file" accept="image/jpeg, image/png, image/jpg" id="input-file">
</div>
</div>

<script>

        function updateQuantity(index, newQuantity) {
            let order = JSON.parse(localStorage.getItem("order")) || [];
            if (newQuantity < 1) {
                newQuantity = 1; // Ensure minimum quantity is 1
            }
            order[index].quantity = parseInt(newQuantity);
            localStorage.setItem("order", JSON.stringify(order));
            populateOrder(); // Re-render the table and update total amount
        }


let receiptPic = document.getElementById("receipt-pic");
let inputFile = document.getElementById("input-file");

inputFile.onchange=function(){
receiptPic.src=URL.createObjectURL(inputFile.files[0])
}

</script>

<script>
// Function to populate the cart table
function populateCart() {
    let cartBody = document.getElementById("cartBody");
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    cartBody.innerHTML = ""; // Clear the table body

    if (cart.length === 0) {
        cartBody.innerHTML = `<tr><td colspan="5">Your cart is empty.</td></tr>`;
    } else {
        cart.forEach((product, index) => {
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

            cartBody.appendChild(row);
        });
    }

    // Update total amount after populating the cart
    updateTotalAmount();
}

// Function to update the total amount in the cart summary
function updateTotalAmount() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    
    // Calculate total amount
    let totalAmount = cart.reduce((total, product) => {
        return total + (product.price * product.quantity);
    }, 0);

    // Update total amount displayed
    document.getElementById("totalAmount").textContent = totalAmount.toFixed(2);
}

// Function to update product quantity
function updateQuantity(index, newQuantity) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    if (newQuantity < 1) {
        newQuantity = 1; // Ensure minimum quantity is 1
    }
    cart[index].quantity = parseInt(newQuantity);
    localStorage.setItem("cart", JSON.stringify(cart));
    populateCart(); // Re-render the table and update total amount
}

// Function to remove a product from the cart
function removeProduct(index) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    cart.splice(index, 1); // Remove the product at the given index
    localStorage.setItem("cart", JSON.stringify(cart));
    populateCart(); // Re-render the table and update total amount
}

// Function to show the modal when the Proceed to Pay button is clicked
function showModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

// Function to close the modal when the close button is clicked
function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

// Function to handle the "Done" button (payment confirmation)
function paymentDone() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    // Save the current cart as an order
    localStorage.setItem("order", JSON.stringify(cart));

    // Clear the cart after payment
    localStorage.removeItem("cart");

alert("payment have been successful");

    // Show payment success notification
    document.getElementById("paymentNotification").style.display = "block";

    // Redirect to the order page after 2 seconds
    setTimeout(function() {
        window.location.href = "order.html";
    }, 2000);
}

// Populate the cart table on page load
document.addEventListener("DOMContentLoaded", populateCart);
</script>

<link rel="stylesheet" href="style1.css">

 <button class="doneButton" id="doneButton" onclick="paymentDone()">Done</button>
      </div>
  </div>

  <!-- Payment Notification -->
  <div id="paymentNotification" style="display: none;">
    <p>Payment sent successfully!</p>
  </div>
</div>

<script>

// Function to populate the cart table
function populateCart() {
    let cartBody = document.getElementById("cartBody");
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    cartBody.innerHTML = ""; // Clear the table body

    if (cart.length === 0) {
        cartBody.innerHTML = `<tr><td colspan="5">Your cart is empty.</td></tr>`;
    } else {
        cart.forEach((product, index) => {
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

            cartBody.appendChild(row);
        });
    }

    // Update total amount after populating the cart
    updateTotalAmount();
}

// Function to update the total amount in the cart summary
function updateTotalAmount() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    
    // Calculate total amount
    let totalAmount = cart.reduce((total, product) => {
        return total + (product.price * product.quantity);
    }, 0);

    // Update total amount displayed
    document.getElementById("totalAmount").textContent = totalAmount.toFixed(2);
}

// Function to update product quantity
function updateQuantity(index, newQuantity) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    newQuantity = parseInt(newQuantity) || 1; // Ensure newQuantity is a valid number

    if (newQuantity < 1) {
        newQuantity = 1; // Minimum quantity is 1
    }

    cart[index].quantity = newQuantity;
    localStorage.setItem("cart", JSON.stringify(cart));
    populateCart(); // Re-render the table and update total amount
}

// Function to remove a product from the cart
function removeProduct(index) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    if (confirm("Are you sure you want to remove this item from the cart?")) {
        cart.splice(index, 1); // Remove the product at the given index
        localStorage.setItem("cart", JSON.stringify(cart));
        populateCart(); // Re-render the table and update total amount
    }
}

// Function to show the modal when the Proceed to Pay button is clicked
function showModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

// Function to close the modal when the close button is clicked
function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

// Function to handle the "Done" button (payment confirmation)
function paymentDone() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    // Save the current cart as an order
    localStorage.setItem("order", JSON.stringify(cart));

    // Clear the cart after payment
    localStorage.removeItem("cart");

alert("payment have been successful");

    // Show payment success notification
    document.getElementById("paymentNotification").style.display = "block";

    // Redirect to the order page after 2 seconds
    setTimeout(function() {
        window.location.href = "order.html";
    }, 2000);
}

// Populate the cart table on page load
document.addEventListener("DOMContentLoaded", populateCart);
</script>

</body>
</html>