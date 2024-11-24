<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-form {
            background-color:  #ffafcc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            box-sizing: border-box;
        }

        .login-form h2 {
		    margin-top:1px;
            margin-bottom:1px;
            text-align: center;
        }

        .login-form input {
            width: 93%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #a2d2ff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .login-form button:hover {
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
	 <div class="form-container">
    <div class="login-form">
        <h2>Login</h2>
        <form action="signinCustomer.php" id="loginForm" method="post">
            <input type="email" name="login-email" id="login-email" placeholder="Email" required>
            <input type="password" name="login-password" id="login-password" placeholder="Password" required>
            <p class="error-message" name="login-email" id="login-error-msg"></p>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
	</div>

    <script>
        function login() {
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            const errorMsg = document.getElementById('login-error-msg');

            // Get stored user details from localStorage
            const storedUser = JSON.parse(localStorage.getItem('userProfile'));

            if (!storedUser || storedUser.email !== email || storedUser.password !== password) {
                errorMsg.textContent = "Invalid email or password!";
                return;
            }

            alert('Login successful!');
            window.location.href = 'home.html';  // Redirect to dashboard or home page
        }
    </script>
</body>
</html>
