<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="productstyles.css">
	<script src="script.js"></script>
</head>
<style>

body {
            font-family: Arial, sans-serif;
             background-image: url("backgroundpic.jpg");
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        }
		
 .search-container {
        display: flex;
  align-items:center;
  height:11vh;
        background-color:#ffafcc;
    }

   /* Logo styling */
    #logo {
        margin-left: 20px;
        max-width: 200px;
        height: 11vh;
    }

    /* Search bar container styling */
    .search-bar {
	height:5px;
	    align-items: center;
        display: flex;
        margin-right:300px;
        display: flex;
        padding: 10px;
        background-color: #ffafcc;
        border-bottom: 1px solid #ccc;
    }

.search-bar input[type="text"] {
    width: 300px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.products-section{
background-image: url("backgroundpic.jpg");
        background-size: cover;
        background-position: center;}
		
		.product{
		background-color:#ffafcc;
		}
		
		#button{
		background-color: #a2d2ff;}
	</style>	
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
    </nav>

 <section class="products-section">

    <div class="product" data-id="1" data-name="Chocolate Jar" data-price="10.00">
	<img src="product1.jpeg" alt="Product 1"  class="product-jpeg" onclick="showModal('modal1')">
        <h2>Chocolate Jar</h2>
        <p>RM10</p>
	
	<!-- Star Rating -->
    <div class="star-rating">
        <span class="star" data-value="1">&#9733;</span>
        <span class="star" data-value="2">&#9733;</span>
        <span class="star" data-value="3">&#9733;</span>
        <span class="star" data-value="4">&#9733;</span>
        <span class="star" data-value="5">&#9733;</span>
    </div>
    <p class="rating-value">Rating: <span id="rating-1">0</span>/5</p>
	<button class="buy-button" onclick="addToCart('Chocolate Jar', 10)">Add to Cart</button>
    </div>


    <div class="product" data-id="1" data-name="Wish Cards" data-price="5.00">
        <img src="product2.jpg" alt="Product 2"  class="product-img" onclick="showModal('modal2')">
        <h2>Wish Cards</h2>
        <p>RM5</p>
		
    <!-- Star Rating -->
    <div class="star-rating">
        <span class="star" data-value="1">&#9733;</span>
        <span class="star" data-value="2">&#9733;</span>
        <span class="star" data-value="3">&#9733;</span>
        <span class="star" data-value="4">&#9733;</span>
        <span class="star" data-value="5">&#9733;</span>
    </div>
    <p class="rating-value">Rating: <span id="rating-1">0</span>/5</p>
	<button class="buy-button" onclick="addToCart('Wish Cards', 5)">Add to Cart</button>
    </div>



    <div class="product" data-id="1"data-name="Printing" data-price="10.00">
        <img src="product3.jpeg" alt="Product 2"  class="product-img" onclick="showModal('modal3')">
        <h2>Printing</h2>
        <p>RM10
    <!-- Star Rating -->
    <div class="star-rating">
        <span class="star" data-value="1">&#9733;</span>
        <span class="star" data-value="2">&#9733;</span>
        <span class="star" data-value="3">&#9733;</span>
        <span class="star" data-value="4">&#9733;</span>
        <span class="star" data-value="5">&#9733;</span>
    </div>
    <p class="rating-value">Rating: <span id="rating-1">0</span>/5</p>
	<button class="buy-button" onclick="addToCart('Wish Cards', 5)">Add to Cart</button>
    </div>
	
</section>


 <!-- Modal Section -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modal1')">&times;</span>
            <h2>Chocolate Jar</h2>
            <p>delicious, indulgent treats filled with layers of rich chocolate, often combined with various toppings like nuts, fruits, or cream for a perfect dessert experience</p>
             <button class="buy-button" onclick="addToCart('Chocolate', 10)">Add to Cart</button>
        </div>
    </div>

    <div id="modal2" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modal2')">&times;</span>
            <h2>Wish Cards</h2>
            <p>thoughtful, personalized messages used to convey heartfelt greetings, blessings, or well-wishes for special occasions and milestones</p>
             <button class="buy-button" onclick="addToCart('Wish Cards', 5)">Add to Cart</button>
        </div>
    </div>

    <div id="modal3" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modal3')">&times;</span>
            <h2>Product 3 Description</h2>
            <p>This is the description for product 3. Highly recommended!</p>
			<p>Please pick an item</p>
			<div class="product" data-id="1"data-name="Printing-Keychain" data-price="10.00">
			<h3>Product 3-Keychain</h3>
			<button class="buy-button" onclick="addToCart('Printing-Keychain', 10)">Add to Cart</button>
			</div>
			<div class="product" data-id="1"data-name="Printing-Polaroid" data-price="10.00">
			<h3>Product 3-Polaroid</h3>
			<button class="buy-button" onclick="addToCart('Printing-Polaroid', 10)">Add to Cart</button>
			</div>
			<div class="product" data-id="1"data-name="Printing-A4 Paper" data-price="10.00">
			<h3>Product 3-A4 Paper</h3>
			<button class="buy-button" onclick="addToCart('Printing-A4 Paper', 10)">Add to Cart</button>
			</div>
        </div>
    </div>
	
<script>
// Function to show the modal when the product image is clicked
function showModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

// Function to close the modal when the close button is clicked
function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

// Close the modal if the user clicks anywhere outside the modal content
window.onclick = function(event) {
    var modals = document.querySelectorAll('.modal');

    modals.forEach(function(modal) {
        if (event.target == modal) {
            modal.style.display = "none"; // Close modal if clicked outside
        }
    });
};

// Function to add a product to the cart
function addToCart(name, price) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let productIndex = cart.findIndex(product => product.name === name);

    if (productIndex > -1) {
        cart[productIndex].quantity += 1; // Increase quantity if already in cart
    } else {
        cart.push({ name, price, quantity: 1 }); // Add new product with quantity 1
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    alert(name + " has been added to the cart!");
}

// Star rating functionality
document.querySelectorAll('.star-rating').forEach(rating => {
    const stars = rating.querySelectorAll('.star');
    const ratingValueElement = rating.nextElementSibling.querySelector('span');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const ratingValue = star.getAttribute('data-value');
            // Update the displayed rating
            ratingValueElement.textContent = ratingValue;

            // Remove the selected class from all stars
            stars.forEach(s => s.classList.remove('selected'));

            // Add the selected class to the clicked star and all previous stars
            star.classList.add('selected');
            let previousStar = star.previousElementSibling;
            while (previousStar) {
                previousStar.classList.add('selected');
                previousStar = previousStar.previousElementSibling;
            }

            // Optionally, you can save this rating to local storage or send it to a server here
            // Example: saveRatingToLocalStorage(productId, ratingValue);
        });
    });
});


function saveRatingToLocalStorage(productId, rating) {
    let ratings = JSON.parse(localStorage.getItem('ratings')) || {};
    ratings[productId] = rating;
    localStorage.setItem('ratings', JSON.stringify(ratings));
}

</script>
<script src="script.js"></script>

</body>
</html>
