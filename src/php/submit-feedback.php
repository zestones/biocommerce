<?php

require "../php/pdo.php";
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

    $user_id = $_SESSION['user_id'];

    if ($announce_id != '' and $user_id != '' and $rating != '' and $comment != '') {
        $query = "INSERT INTO AnnounceComment (announce_id, user_id, rating, comment) VALUES (:announce_id, :user_id, :rating, :comment)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':announce_id', $announce_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
    }
}