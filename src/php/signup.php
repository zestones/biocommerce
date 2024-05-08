<?php
// Include pdo.php to get the $pdo connection object
require './pdo.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number']; // Assuming phone_number is the name of the input field for phone number
    $password = $_POST['password'];

    // Check if the user with the same email already exists
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // If the user already exists, redirect back to signup page with an error message
    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        http_response_code(400);
        echo "Email already taken";
        exit();
    }

    // If the user doesn't exist, insert the new user into the database
    $query = "INSERT INTO users (email, phone_number, password) VALUES (:email, :phone_number, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    header('Location: ../pages/connexion/login.html');
    exit();
}
?>