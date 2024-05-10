<?php

require "../php/feedback.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data
    $postData = file_get_contents("php://input");

    // Decode the JSON string into a PHP associative array
    $requestData = json_decode($postData, true);

    // Retrieve data from the decoded JSON
    $announce_id = isset($requestData['announce_id']) ? $requestData['announce_id'] : '';
    $rating = isset($requestData['rating']) ? $requestData['rating'] : '';
    $comment = isset($requestData['comment']) ? $requestData['comment'] : '';

    if ($announce_id != '' and $rating != '' and $comment != '') {
        insert_new_feedback($announce_id, $rating, $comment);
        $response = get_last_inserted_feedback();
        $response['user'] = get_user_by_id($_SESSION['user_id']);
    } else {
        $response['error'] = "Invalid data";
    }
}

// Send the response back to the frontend
header('Content-Type: application/json');
echo json_encode($response);
?>