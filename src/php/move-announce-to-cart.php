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

    if ($announce_id == '') {
        echo json_encode(["success" => false, "message" => "Please provide an announce id."]);
        return;
    }

    move_announce_to_cart($announce_id);
    echo json_encode(["success" => true, "message" => "Announce moved to the shopping cart."]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}