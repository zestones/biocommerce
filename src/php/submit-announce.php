<?php

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
    // Check if all required fields are filled
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

        // Handle image upload
        $targetDir = "../public/"; // Directory where images will be stored
        $targetFile = $targetDir . basename($_FILES["image-upload"]["name"]); // Path to store the uploaded image

        if (move_uploaded_file($_FILES["image-upload"]["tmp_name"], $targetFile)) {

            echo "The file " . basename($_FILES["image-upload"]["name"]) . " has been uploaded.";
            // TODO: Execute SQL query

        } else {
            // Handle upload errors
            handle_image_upload_errors();
        }
    }
} else {
    // Handle missing fields
    echo "Please fill all the required fields.";
}

?>