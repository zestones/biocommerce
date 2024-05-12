<?php

require '../php/user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    $user = get_user_by_email($email);

    if ($user) {
        http_response_code(400);
        echo "Email already taken";
        return;
    } else {
        $success = insert_new_user($email, $password, $phone_number);
        echo "Account created successfully!";
    }

    header('Location: ../pages/login.html');
}
?>