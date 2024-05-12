<?php

require "../php/announce.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postData = file_get_contents("php://input");

    $requestData = json_decode($postData, true);
    if ($requestData !== null) {
        $cart = $requestData['cart'];

        foreach ($cart as $item) {
            $announce_id = $item['announce_id'];
            $quantity = $item['quantity'];

            $row_count = update_cart_quantity_by_announce_id($announce_id, $quantity);
        }
        echo json_encode(["success" => $row_count, "message" => "Cart updated successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid JSON data"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}

?>