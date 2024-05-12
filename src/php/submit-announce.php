<?php

require "../php/announce.php";
require "../php/image_helper.php";
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['category'], $_POST['title'], $_POST['description'], $_POST['price'], $_POST['quantity']) &&
        !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['quantity'])
    ) {
        // Retrieve form data
        $category = $_POST['category'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $targetDir = "../public/";

        $images_path = [];
        foreach ($_FILES["pictures"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
                $name = basename($_FILES["pictures"]["name"][$key]);

                $targetFile = $targetDir . $_SESSION["user_id"] . "/announce/";
                if (!file_exists($targetFile)) {
                    mkdir($targetFile, 0777, true);
                }

                $targetFile .= $name;
                if (move_uploaded_file($tmp_name, $targetFile)) {
                    $images_path[] = $targetFile;
                } else {
                    handle_image_upload_errors($_FILES["pictures"]["error"][$key]);
                }
            }
        }

        insert_announce($title, $description, $category, $price, $quantity, $images_path);
        header('Location: ../pages/home.php');
    }
} else {
    echo "Please fill all the required fields.";
}

?>