<?php
require "../php/transaction.php";
require "../php/announce.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postData = file_get_contents("php://input");
    $requestData = json_decode($postData, true);

    if (
        isset($requestData["cart"], $requestData["total"]) &&
        !empty($requestData["cart"]) && !empty($requestData["total"])
    ) {
        $cart = $requestData["cart"];
        $is_admin = $requestData["total"];

        foreach ($cart as $announce) {
            $announce_id = $announce["announce_id"];
            $announce_name = $announce["name"];
            $announce_quantity = $announce["quantity"];
            $announce_price = $announce["price"];

            // create a new transaction
            $success = insert_transaction($_SESSION["user_id"], $announce_name, $announce_quantity, $announce_price);
            if (!$success) {
                echo json_encode(["success" => false, "message" => "An error occurred while saving the transaction."]);
                break;
            }

            // update announce quantity
            $sucess = decrease_announce_quantity($announce_id, $announce_quantity);
            if (!$success) {
                echo json_encode(["success" => false, "message" => "An error occurred while updating the announce quantity."]);
                break;
            }

            // delete announce from cart
            $success = delete_announce_from_cart($announce_id, $_SESSION["user_id"]);
            if (!$success) {
                echo json_encode(["success" => false, "message" => "An error occurred while deleting the announce from the cart."]);
                break;
            }
        }

        if ($success) {
            echo json_encode(["success" => true, "message" => "Transaction completed successfully."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Please provide user_id and is_admin fields."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>