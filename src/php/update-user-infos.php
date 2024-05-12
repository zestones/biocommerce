<?php

require "../php/image_helper.php";
require "../php/user.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["firstname"], $_POST["lastname"], $_POST["username"], $_POST["phonenumber"]) &&
        !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["username"]) && !empty($_POST["phonenumber"])
    ) {
        // retrieve the user's data
        $user_id = $_SESSION['user_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $phonenumber = $_POST['phonenumber'];
        $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : '../public/default-user-icon.png';

        $targetDir = "../public/";
        $targetDir = $targetDir . $_SESSION["user_id"] . "/avatar/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $tmp_name = $_FILES["avatar"]["tmp_name"];
        $basename = basename($_FILES["avatar"]["name"]);

        if ($basename == '') {
            $targetFile = get_user_avatar($user_id);
            $success = update_user_infos_by_id($user_id, $firstname, $lastname, $username, $phonenumber, $targetFile);
        } else {
            $targetFile = $targetDir . $basename;
            if (move_uploaded_file($tmp_name, $targetFile)) {
                $success = update_user_infos_by_id($user_id, $firstname, $lastname, $username, $phonenumber, $targetFile);
            } else {
                handle_image_upload_errors($_FILES["avatar"]["error"]);
                $success = false;
            }
        }
    }
}

header("Location: ../pages/settings.php");

?>