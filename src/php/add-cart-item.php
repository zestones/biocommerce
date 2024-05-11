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
    $quantity = isset($requestData['quantity']) ? $requestData['quantity'] : 0;

    if ($announce_id != '') {
        $saved_announce = get_saved_announce_by_id($announce_id);
        if ($saved_announce["is_in_cart"]) {
            remove_announce_from_shopping_cart($announce_id);
            $response['removed'] = true;
        } else {
            add_announce_to_shopping_cart($announce_id, $quantity);
            $response['saved'] = true;
        }
    } else {
        $response['error'] = "Invalid data";
    }
}

// Send the response back to the frontend
header('Content-Type: application/json');
echo json_encode($response);
?>