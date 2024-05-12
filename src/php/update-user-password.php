<?php
require "../php/user.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["old-password"], $_POST["new-password"], $_POST["confirm-password"]) &&
        !empty($_POST["old-password"]) && !empty($_POST["new-password"]) && !empty($_POST["confirm-password"])
    ) {
        $old_password = $_POST["old-password"];
        $new_password = $_POST["new-password"];
        $confirm_password = $_POST["confirm-password"];

        $user = get_user_by_id($_SESSION["user_id"]);

        echo "old_password:" . $old_password;
        echo "db pass:" . $user['password'];

        if ($old_password === $user["password"]) {
            if ($new_password === $confirm_password) {
                $success = update_user_password_by_id($_SESSION["user_id"], $new_password);
                if ($success) {
                    header("Location: ../pages/settings.php");
                } else {
                    echo "An error occurred while updating the password.";
                    exit;
                }
            } else {
                echo "The new password and the confirm password do not match.";
                exit;
            }
        } else {
            echo "The old password is incorrect.";
            exit;
        }
    } else {
        echo "Please fill all the required fields.";
        exit;
    }
}

header("Location: ../pages/settings.php");
?>