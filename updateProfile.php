<?php
require 'include/db_conn.php';

session_start();
   $uid=$_POST['user_id'];
   $username=$_POST['username'];
   $age=$_POST['age'];
   $phone_no=$_POST['phone_no'];
   $address=$_POST['address'];
   $email=$_POST['email'];
   $password=$_POST['password'];

    $query1="update users set username='".$username."',age='".$age."',address='".$address."',phone_no='".$phone_no."',email='".$email."',password='".$password."'  where user_id='".$uid."'";

   if(mysqli_query($con,$query1)){
	       // Image handling code
    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create the uploads directory if it doesn't exist
        }

        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check for upload errors
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            echo "Upload error: " . $_FILES['image']['error'];
            exit;
        }

        // Check if the file is an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Step 1: Check if an image already exists for the admin
        $sql_check = "SELECT imageid, image_path FROM images WHERE user_id = '$uid'";
        $result_check = mysqli_query($con, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Step 2: If an image exists, delete the old image file
            $row = mysqli_fetch_assoc($result_check);
            $existing_image_path = $row['image_path'];
            $imageid = $row['imageid'];

            // Delete the old image if it exists
            if ($existing_image_path && file_exists($existing_image_path)) {
                unlink($existing_image_path); // Delete the old image
            }

            // Step 3: Proceed with uploading the new image
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                // Attempt to move the uploaded file to the target location
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

                    // Change file permissions to 0777
                    chmod($target_file, 0777);

                    // Update the image path in the database for the current admin
                    $sql_update_image = "UPDATE images SET image_path='$target_file' WHERE user_id='$uid'";
                    if (mysqli_query($con, $sql_update_image)) {
                        echo "Image updated successfully!";
                        $_SESSION['profile_pic'] = $target_file; // Update session with new image
                    } else {
                        echo "Error updating image: " . mysqli_error($con);
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            // No previous image exists, insert the new image
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                // Attempt to move the uploaded file to the target location
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

                    // Change file permissions to 0777
                    chmod($target_file, 0777);

                    // Insert the new image path into the database
                    $imageid = uniqid('img_');
                    $sql_insert = "INSERT INTO images (imageid, user_id, image_path) VALUES ('$imageid', '$uid', '$target_file')";
                    if (mysqli_query($con, $sql_insert)) {
                        echo "New image inserted successfully!";
                        $_SESSION['profile_pic'] = $target_file; // Update session with new image
                    } else {
                        echo "Error inserting image: " . mysqli_error($con);
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }

        // Update the users table with the imageid
        $query_update_user_image = "UPDATE users SET imageid='$imageid' WHERE user_id='$uid'";
        mysqli_query($con, $query_update_user_image);
    } else {
        // No file uploaded - just update the profile without an image
        echo "No file uploaded.";
    }
            echo "<html><head><script>alert('Member Update Successfully');</script></head></html>";
            echo "<meta http-equiv='refresh' content='0; url=../SMS/customer'>";
        }else{
             echo "<html><head><script>alert('ERROR! Update Opertaion Unsucessfull');</script></head></html>";
             echo "error".mysqli_error($con);
        }
	


?>