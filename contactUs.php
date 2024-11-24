<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // You can handle the data here (e.g., send an email or save to a database)
    // Example of sending email:
    $to = "yourcompany@example.com";
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for your message. We will get back to you soon.";
    } else {
        echo "Sorry, there was an issue sending your message.";
    }
}
?>
