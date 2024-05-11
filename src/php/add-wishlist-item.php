<?php

require "../php/announce.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data
    $postData = file_get_contents("php://input");

    // Decode the JSON string into a PHP associative array
    $requestData = json_decode($postData, true);

    // Retrieve data from the decoded JSON
    $announce_id = isset($requestData['announce_id']) ? $requestData['announce_id'] : '';

    if ($announce_id != '') {
        add_announce_to_wishlist($announce_id);
        $response['message'] = "Item added successfully";
    } else {
        $response['error'] = "Invalid data";
    }
}

// Send the response back to the frontend
header('Content-Type: application/json');
echo json_encode($response);
?>