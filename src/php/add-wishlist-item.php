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
        $saved_announce = get_saved_announce_by_id($announce_id);
        if ($saved_announce["is_in_favourite"]) {
            remove_announce_from_wishlist($announce_id);
            echo json_encode(["success" => true, "message" => "Announce removed from the wishlist.", "removed" => true]);
        } else {
            add_announce_to_wishlist($announce_id);
            echo json_encode(["success" => false, "message" => "Announce added to the wishlist.", "saved" => true]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Please provide an announce id."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

?>