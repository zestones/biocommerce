<?php

require "../php/announce.php";
session_start();

function handle_image_upload_errors()
{
    switch ($_FILES["image-upload"]["error"]) {
        case UPLOAD_ERR_INI_SIZE:
            echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
            break;
        case UPLOAD_ERR_PARTIAL:
            echo "The uploaded file was only partially uploaded.";
            break;
        case UPLOAD_ERR_NO_FILE:
            echo "No file was uploaded.";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            echo "Missing a temporary folder.";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            echo "Failed to write file to disk.";
            break;
        case UPLOAD_ERR_EXTENSION:
            echo "A PHP extension stopped the file upload.";
            break;
        default:
            echo "Sorry, there was an error uploading your file.";
            break;
    }
}

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
                    // Handle upload errors
                    handle_image_upload_errors();
                }
            }
        }

        insert_announce($title, $description, $category, $price, $quantity, $images_path);
    }
} else {
    // Handle missing fields
    echo "Please fill all the required fields.";
}

?>