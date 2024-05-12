<?php
require "../php/announce.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["id"], $_POST["edit-title"], $_POST["edit-description"], $_POST["edit-price"], $_POST["edit-quantity"]) &&
        !empty($_POST["id"]) && !empty($_POST["edit-title"]) && !empty($_POST["edit-description"] && !empty($_POST["edit-price"]) && !empty($_POST["edit-quantity"]))
    ) {
        $id = $_POST["id"];
        $title = $_POST["edit-title"];
        $description = $_POST["edit-description"];
        $quantity = $_POST["edit-quantity"];
        $price = $_POST["edit-price"];

        $user_id = $_SESSION["user_id"];

        $success = update_user_announce_by_id($id, $title, $description, $price, $quantity);

        if ($success) {
            echo json_encode(["success" => true, "message" => "Announce updated successfully!", "title" => $title, "description" => $description, "quantity" => $quantity, "price" => $price]);
        } else {
            echo json_encode(["success" => false, "message" => "An error occurred while updating the announce."]);
        }

    } else {
        echo json_encode(["success" => false, "message" => "Please fill all the required fields."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>