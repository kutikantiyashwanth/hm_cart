<?php
session_start(); // Start the session to get session variables

// Check if the user is logged in by checking the session variable
if (isset($_SESSION['email'])) {
    // User is logged in, display a welcome message
    echo "<h1>Welcome, " . $_SESSION['email'] . "!</h1>";
    echo "<p>You are logged in successfully.</p>";
    
    // You can add more content here for logged-in users
} else {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit();
}
?>
