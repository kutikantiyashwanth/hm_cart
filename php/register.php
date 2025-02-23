<?php
{
    // Registration Process
    $conn = new mysqli('localhost', 'root', '', 'store');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  
    echo "test";
    // Get user input from the registration form
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt the password

    // Insert data into the store table
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')"; // Ensure the table name is 'store'

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! You can now login.";
        // Immediate redirect to index.html
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
