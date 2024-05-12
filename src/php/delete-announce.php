<?php

require "../php/announce.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data
    $postData = file_get_contents("php://input");

    // Decode the JSON string into a PHP associative array
    $requestData = json_decode($postData, true);

    // Retrieve data from the decoded JSON
    $announce_id = isset($requestData['id']) ? $requestData['id'] : '';

    if ($announce_id != '') {
        $success = delete_announce_by_id($announce_id);
        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Announce deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete announce']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid announce id']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

?>