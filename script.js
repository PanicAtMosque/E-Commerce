// Function to search products based on user input
function searchProducts() {
    const input = document.getElementById('searchBar').value.trim().toLowerCase();
    const products = document.querySelectorAll('.product');

    products.forEach(product => {
        const productName = product.getAttribute('data-name').toLowerCase();
        
        // Display product if it matches the search input
        if (productName.includes(input)) {
            product.style.display = "block";  // Show the product
        } else {
            product.style.display = "none";  // Hide the product
        }
    });
}

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

    stars.forEach((star, index) => {
        // Hover effect for temporary highlight on mouseover
        star.addEventListener('mouseover', () => {
            resetStars(rating); // Reset the stars before applying hover effect

            // Highlight current star and all stars to the left (left-to-right glowing)
            for (let i = 0; i <= index; i++) {
                stars[i].classList.add('hover');
            }
        });

        // Remove hover effect when mouse leaves the star rating section
        rating.addEventListener('mouseout', () => {
            resetStars(rating); // Clear hover effect
        });

        // Click event to lock in the rating
        star.addEventListener('click', () => {
            const ratingValue = star.getAttribute('data-value');
            ratingValueElement.textContent = ratingValue;

            // Remove the 'selected' class from all stars
            stars.forEach(s => s.classList.remove('selected'));

            // Highlight the clicked star and all stars before it (left-to-right)
            for (let i = 0; i <= index; i++) {
                stars[i].classList.add('selected');
            }

            // Save the rating to local storage or database if needed
            const productId = rating.closest('.product').getAttribute('data-id');
            saveRatingToLocalStorage(productId, ratingValue);
        });
    });
});

// Helper function to reset the stars (clearing hover effect)
function resetStars(rating) {
    const stars = rating.querySelectorAll('.star');
    stars.forEach(star => star.classList.remove('hover'));
}

// Function to populate the cart table
function populateCart() {
    let cartBody = document.getElementById("cartBody");
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    cartBody.innerHTML = ""; // Clear the table body

    if (cart.length === 0) {
        cartBody.innerHTML = `<tr><td colspan="4">Your cart is empty.</td></tr>`;
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

// Populate the cart table on page load
document.addEventListener("DOMContentLoaded", populateCart);



// Function to handle "Proceed to Pay" button click
document.getElementById("proceedToPay").addEventListener("click", function() {
    let qrCodeContainer = document.getElementById("qrCodeContainer");
    qrCodeContainer.style.display = "block";



// Function to handle payment completion
function paymentDone() {
    closeModal('modal1'); // Hide the modal

    // Show the payment notification
    let paymentNotification = document.getElementById("paymentNotification");
    paymentNotification.style.display = "block";
