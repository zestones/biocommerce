<?php
// Include pdo.php to get the $pdo connection object
require './pdo.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists in the database
    $query = "SELECT * FROM users WHERE email = :email AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Check if the user exists
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // User exists, do something (e.g., set session variables, redirect to dashboard)
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        // Redirect to dashboard or home page
        echo "Login successful";
        exit();
    } else {
        // User doesn't exist or incorrect credentials
        // Redirect back to the login page with an error message
        echo "Invalid email or password";
        exit();
    }
}
?>