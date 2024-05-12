<?php

require "../php/announce.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data
    $postData = file_get_contents("php://input");

    // Decode the JSON string into a PHP associative array
    $requestData = json_decode($postData, true);

    // Retrieve data from the decoded JSON
    $id = isset($requestData['id']) ? $requestData['id'] : '';

    if ($id != '') {
        delete_saved_announce($id);
        echo json_encode(["success" => true, "message" => "Announce removed from the wishlist."]);
    } else {
        echo json_encode(["success" => false, "message" => "Please provide an announce id."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

?>