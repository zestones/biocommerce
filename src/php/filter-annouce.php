<?php

session_start();
include '../php/announce.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data
    $postData = file_get_contents("php://input");

    // Decode the JSON string into a PHP associative array
    $requestData = json_decode($postData, true);

    // Retrieve data from the decoded JSON
    $categories = isset($requestData['category']) ? $requestData['category'] : array();
    $minPrice = isset($requestData['minPrice']) ? $requestData['minPrice'] : 0;
    $maxPrice = isset($requestData['maxPrice']) ? $requestData['maxPrice'] : 0;
    $keyword = isset($requestData['keyword']) ? $requestData['keyword'] : '';

    if (count($categories) == 0 and $minPrice == 0 and $maxPrice == 0 and $keyword == '') {
        $announce = get_all_announce();
    } else {
        $announce = get_filtered_announce($categories, $keyword, $minPrice, $maxPrice);
    }

    if (count($announce) > 0) {
        display_announce($announce);
    } else {
        echo "<h1>No announce found</h1>";
    }
}