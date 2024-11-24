<?php
include 'include/db_conn.php';

// Assuming the session is already started during login
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user_id_auth = ltrim($_POST['login-email']);
$user_id_auth = rtrim($_POST['login-email']);
$pass_key = ltrim($_POST['login-password']);
$pass_key = rtrim($_POST['login-password']);
$user_id_auth = stripslashes($user_id_auth);
$pass_key     = stripslashes($pass_key);

if ($pass_key == "" &&  $user_id_auth == "") {
    echo "<head><script>alert('Username and Password cannot be empty');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
} elseif ($pass_key == "") {
    echo "<head><script>alert('Password cannot be empty');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
} elseif ($user_id_auth == "") {
    echo "<head><script>alert('Username cannot be empty');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
} else {
    // Escape the input to prevent SQL injection
    $user_id_auth = mysqli_real_escape_string($con, $user_id_auth);
    $pass_key     = mysqli_real_escape_string($con, $pass_key);

        $sql = "SELECT u.user_id, u.username, u.user_type,u.age,u.phone_no,u.address,u.email,u.password
                FROM users u
                WHERE u.email = '$user_id_auth' AND u.password = '$pass_key'";

    }
	
    $result = mysqli_query($con, $sql);
    $count  = mysqli_num_rows($result);

    if ($count == 1) {
        // Fetch the user's or admin's data
        $row = mysqli_fetch_assoc($result);

        // Store session data based on whether it's an admin, member, or coach login
        session_start();
		$_SESSION['user_id']        = $row['user_id'];  // Store user_id in session
        $_SESSION['user_data']      = $row['username'];  // Store username in session
        $_SESSION['logged']         = "start";
        $_SESSION['user_type']      = $row['user_type']; // 'admin', 'member', or 'coach'
        $_SESSION['username']       = $row['username'];  // Username from the session
		$_SESSION['age']            = $row['age'];  // age customer
		$_SESSION['phone_no']       = $row['phone_no'];  // phone number customer
		$_SESSION['address']        = $row['address']; // address customer
		$_SESSION['email']          = $row['email'];  // address customer
		$_SESSION['password']       = $row['password'];  // address customer

        // Redirect based on the user's or admin's authority level, 1 = admin, 2 = customer, 3 = seller
        if ($_SESSION['user_type'] == "1") {
            header("location: ../SMS/index.php");
        } elseif ($_SESSION['user_type'] == "2") {
            header("location: ../SMS/customer/index.php");
        } elseif ($_SESSION['user_type'] == "3") {
            header("location: ../SMS/Seller/index.php");
        } else {
            echo "<html><head><script>alert('Invalid');</script></head></html>";
            echo "<meta http-equiv='refresh' content='0; url=index.php'>";
        }
    } else {
        echo "<html><head><script>alert('Username OR Password is Invalid');</script></head></html>";
        // Redirect based on whether it was an admin, coach, or user login
            echo "<meta http-equiv='refresh' content='0; url=login.php'>";  // Redirect to the user login page (homepage)
    }
?>