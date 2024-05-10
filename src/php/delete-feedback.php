<?php

require "../php/feedback.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data
    $postData = file_get_contents("php://input");

    // Decode the JSON string into a PHP associative array
    $requestData = json_decode($postData, true);

    // Retrieve data from the decoded JSON
    $feedback_id = isset($requestData['feedback_id']) ? $requestData['feedback_id'] : '';

    if ($feedback_id != '') {
        delete_feedback_by_id($feedback_id);
        $response['message'] = "Feedback deleted";
    } else {
        $response['error'] = "Invalid data";
    }
}

// Send the response back to the frontend
header('Content-Type: application/json');
echo json_encode($response);
?>