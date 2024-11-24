<?php
require 'include/db_conn.php';

// Sanitize and validate user input (optional but recommended)
$uid = mysqli_real_escape_string($con, $_POST['user_id']);
$username = mysqli_real_escape_string($con, $_POST['username']);
$age = mysqli_real_escape_string($con, $_POST['age']);
$phone = mysqli_real_escape_string($con, $_POST['phone_no']);
$address = mysqli_real_escape_string($con, $_POST['address']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']); 

$query1 = "UPDATE users SET username = ".$username.", age = ".$age.",phone_no = ".$phone.", address = ".$address.", email = ".$email.", password = ".$password." WHERE uid = ".$uid." ";

 if(mysqli_query($con,$query1)){
            echo "<html><head><script>alert('Member Update Successfully');</script></head></html>";
            echo "<meta http-equiv='refresh' content='0; url=../SMS/customer'>";
        }else{
             echo "<html><head><script>alert('ERROR! Update Opertaion Unsucessfull');</script></head></html>";
             echo "error".mysqli_error($con);
        }


mysqli_close($con);
?>