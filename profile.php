<?php
require 'include/db_conn.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    // No user is logged in
    $user_data = null;
    $image_data = null;
} else {
    // Fetch user data
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();
    $stmt->close();

    // Fetch image data
    $sql = "SELECT * FROM images WHERE user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $image_data = $result->fetch_assoc();
    $stmt->close();
}

$con->close();
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <style>
    /* General body styling */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
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


    .profile-container {
      max-width: 600px;
      margin: auto;
      padding: 20px;
      border: 5px solid #ddd;
      border-radius: 5px;
      background-color: #fff;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-container h2 {
      text-align: center;
    }

    .profile-item {
      margin-bottom: 10px;
    }

    .profile-item label {
      font-weight: bold;
    }

    .profile-pic {
      max-width: 150px;  /* Adjust the profile picture size */
      display: block;
      margin: 0 auto 20px;  /* Center the profile picture */
      border-radius: 50%;   /* Make the image circular */
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
      <li><button class="dropdown-content">Menu</button></li>
  
    </ul>
  </nav>
  
<script>
function populateMenu(userType) {
    const dropdownContent = document.querySelector('.dropdown-content');
    dropdownContent.innerHTML = ''; // Clear existing content

    if (userType === "1") {
        dropdownContent.innerHTML += '<a href="../SMS/index.php">Dashboard</a>';
    } else if (userType === "2") {
        dropdownContent.innerHTML += '<a href="../SMS/customer/index.php">Menu</a>';
    } else if (userType === "3") {
        dropdownContent.innerHTML += '<a href="../SMS/Seller/index.php">Seller Dashboard</a>';
    } else {
        dropdownContent.innerHTML += '<a href="index.php">Login</a>';
        alert('Invalid user type');
    }
}

// Assume user type is fetched and available as a JavaScript variable
const userType = "<?php echo $_SESSION['user_type']; ?>";
populateMenu(userType);
</script>
  <div class="profile-container">
    <h2>User Profile</h2>


<style>
body {
            font-family: Arial, sans-serif;
             background-image: url("backgroundpic.jpg");
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        }
		
.profile-container{
margin-top:10px;
		background-color: #ffafcc;
		border-color:#ffafcc;
		height:80vh
		}
		
.profilePic{
	width: 400px;
	background-color:#ffafcc;
	margin-top:1px;
	border-radius:15px;
	text-align:center;
	color:#333;
}


.profilePic img{
	width: 180px;
	height:180px;
	border-radius:20%;
	margin-top:1px;
	margin-left:50%;
	margin-bottom:20px;
	justify-content:center;
}

#profileLabel{
	display:block;
	margin-left:60%;
	width: 100px;
	background-color: #a2d2ff;
	color:#fff;
	padding:12px;
    font-size: 14px;
    transition: opacity 0.3s ease;
    border-radius: 5px;
    cursor: pointer;
}

#profileButton{
	display:block;
	width: 100px;
	background-color: #a2d2ff;
	color:#fff;
	padding:2px;
    font-size: 17px;
font-weight: bold;
    transition: opacity 0.3s ease;
    border-radius: 5px;
    cursor: pointer;
	border-color:#a2d2ff;
	  display: inline-block;
}

 .profilePic:hover #profileLabel {
            background-color: #bde0fe;
        }

 .profilePic:hover #profileButton{
            background-color: #bde0fe;
        }
input{
	display:none;
}

.box {
	display: block;
	margin-left: auto;
	margin-right: auto;
	width: 50%;
	
}
</style>

<script>

let profilePic = document.getElementById("profilePic");
let inputFile = document.getElementById("input-file");

inputFile.onchange=function(){
profilePic.src=URL.createObjectURL(inputFile.files[0])
}
function saveProfile() {
    const profilePicSrc = profilePic.src;
    localStorage.setItem('profilePicSrc', profilePicSrc);
}

function loadProfile() {
    const savedProfilePicSrc = localStorage.getItem('profilePicSrc');
    if (savedProfilePicSrc) {
        profilePic.src = savedProfilePicSrc;
    }
}

// Call loadProfile on page load to restore the saved profile picture
window.onload = loadProfile;
</script>

    <?php if ($user_data): ?>
<?php
$image_path = isset($image_data['image_path']) ? $image_data['image_path'] : '';
?>

<div class="box" id="image-container" style="margin-top: 25px!important;">
    <img id="preview-image" height="200" text-align="" src="<?php echo htmlspecialchars($image_path, ENT_QUOTES, 'UTF-8'); ?>" alt="Profile Image" style="<?php echo $image_path ? '' : 'display:none;'; ?>">
</div>

      <div class="profile-item">
          <label for="profileName">Name:</label>
          <span><?php echo htmlspecialchars($user_data['username'], ENT_QUOTES, 'UTF-8'); ?></span>
      </div>
      <div class="profile-item">
          <label for="profileAge">Age:</label>
          <span><?php echo htmlspecialchars($user_data['age'], ENT_QUOTES, 'UTF-8'); ?></span>
      </div>
      <div class="profile-item">
          <label for="profilePhone">Phone Number: +60</label>
          <span><?php echo htmlspecialchars($user_data['phone_no'], ENT_QUOTES, 'UTF-8'); ?></span>
      </div>
      <div class="profile-item">
          <label for="profileAddress">Address:</label>
          <span><?php echo htmlspecialchars($user_data['address'], ENT_QUOTES, 'UTF-8'); ?></span>
      </div>
      <div class="profile-item">
          <label for="profileEmail">Email:</label>
          <span><?php echo htmlspecialchars($user_data['email'], ENT_QUOTES, 'UTF-8'); ?></span>
      </div>
      <div class="profile-item">
          <label for="profilePassword">Password:</label>
          <span><?php echo htmlspecialchars($user_data['password'], ENT_QUOTES, 'UTF-8'); ?></span>
      </div>
    <?php else: ?>
      <p>No user is logged in</p>
    <?php endif; ?>
  </div>



</body>
</html>

