<?php
if (!session_start()) {
    die("Session failed to start");
}

// Login Process
$conn = new mysqli('localhost', 'root', '', 'store');

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the login form and sanitize it
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'];

// Make sure no output is sent before header()
ob_start();

if ($email && $password) {
    // Prepare and bind statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If email exists, fetch the user data
        $row = $result->fetch_assoc();

        // Verify the password using password_verify
        if (password_verify($password, $row['password'])) {
            // Password is correct, login successful
            $_SESSION['email'] = $email; // Store email in session
            
            // Set a cookie to indicate logged-in status for HTML
            setcookie("user_email", $email, time() + (86400 * 30), "/"); // 30 days
            
            // Immediate redirect to index.html
            header("Location: index.html");
            exit();
        } else {
            // Password is incorrect
            echo "Incorrect password.";
        }
    } else {
        // Email not found
        echo "No user found with that email.";
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "Invalid email or password.";
}

// Close the database connection
$conn->close();
ob_end_flush(); // Send output buffer and turn off buffering
?>
