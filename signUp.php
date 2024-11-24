<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
             background-image: url("backgroundpic.jpg");
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        }

        /* Flexbox for centering only the form */
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }

        .signup-form {
		    margin-top:1px;
            background-color: #ffafcc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
			height:88vh;
            box-sizing: border-box;
			margin-bottom:1px;
        }

        .signup-form h2 {
		    height:13vh;
		    margin-top:1px;
            margin-bottom:1px;
            text-align: center;
        }


        .signup-form input {
            width: 93%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .signup-form button {
            width: 100%;
            padding: 10px;
            background-color: #a2d2ff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .signup-form button:hover {
            background-color: #bde0fe;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }

        /* Navigation Bar */
        .navbar {
            background-color: #333;      /* Dark background for the navbar */
            padding: 10px;
            text-align: center;          /* Center-align the menu */
        }

        .navbar ul {
            list-style-type: none;       /* Remove bullet points */
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            display: inline;             /* Display the items inline */
            margin-right: 20px;          /* Add spacing between menu items */
        }

        .navbar ul li a {
            color: white;                /* White text for the menu */
            text-decoration: none;       /* Remove underline from links */
            font-size: 18px;
            padding: 10px 20px;
        }

        .navbar ul li a:hover {
            background-color: #555;      /* Darker background on hover */
            border-radius: 5px;
        }
	#logo {
    max-width: 200px;
    height: 100px;
}
		}
		
    </style>
</head>
<body>

    <!-- Navigation Menu -->
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

    <!-- Form Container for Centering -->
    <div class="form-container">
        <div class="signup-form">
            <h2><img src="ShopBySyaSya00.png" id="logo"></h2>

            <!-- Signup Page Example -->
<form action="signupCustomer.php" id="signupForm" method="post">
    <input type="text" name="name" id="name" placeholder="Name" required>
    <input type="number" name="age" id="age" placeholder="Age" required>
	<input type="number" name="phone_no" id="phone_no" placeholder="Phone" required>
    <input type="text" name="address" id="address" placeholder="Address" required>
    <input type="email" name="email" id="email" placeholder="Email" required>
    <input type="password" name="password" id="password" placeholder="Password" required>
    <button type="submit">Sign Up</button>
</form>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>

<script>
    function saveUser() {
        const name = document.getElementById('name').value;
        const age = document.getElementById('age').value;
		const phone_number = document.getElementById('phone_number').value;
        const address = document.getElementById('address').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        const userProfile = {
            name,
            age,
			phone_number,
            address,
            email,
            password
        };

        // Store the user profile in localStorage
        localStorage.setItem('userProfile', JSON.stringify(userProfile));

        alert("Sign up successful!");
        window.location.href = 'login.php'; // Redirect to profile page
    }
</script>

</body>
</html>


