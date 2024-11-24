<?php
require 'include/db_conn.php';

$username = mysqli_real_escape_string($con, $_POST['username']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$age = mysqli_real_escape_string($con, $_POST['age']);
$phone = mysqli_real_escape_string($con, $_POST['phone_no']);
$address = mysqli_real_escape_string($con, $_POST['address']);


try {
    // Start transaction
    mysqli_begin_transaction($con);
	
$query = "INSERT INTO users (username, user_type, password, email, age, address ,phone_no)
VALUES ('$username', '2', '$password', '$email','$age','$address', '$phone')";
    if (!mysqli_query($con, $query)) {
        throw new Exception("Sign-up Failed " . mysqli_error($con));
    }
	
	mysqli_commit($con);
    echo "<script>alert('Member Added Successfully');</script>";
    echo "<meta http-equiv='refresh' content='0; url=signUp.php'>";
} catch (Exception $e) {
    // Rollback the transaction in case of error
    mysqli_rollback($con);
    // Log error and show user-friendly message
    error_log($e->getMessage());
    echo "<script>alert('Sign-up Failed: " . $e->getMessage() . "');</script>";
    echo "<meta http-equiv='refresh' content='0; url=signUp.php'>";
}
?>