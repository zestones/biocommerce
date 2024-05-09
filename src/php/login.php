<?php

require './pdo.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM User WHERE email = :email AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];

        echo 'user id \'' . $_SESSION['user_id'] . '\'<br>';
        echo 'email \'' . $_SESSION['email'] . '\'<br>';

        header('Location: ../pages/home.php');
    } else {
        http_response_code(400);
        echo "Invalid email or password";
    }
}
?>