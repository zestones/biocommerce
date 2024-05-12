<?php
require "../php/user.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postData = file_get_contents("php://input");
    $requestData = json_decode($postData, true);

    if (
        isset($requestData["user_id"], $requestData["is_admin"]) &&
        !empty($requestData["user_id"])
    ) {
        $user_id = $requestData["user_id"];
        $is_admin = $requestData["is_admin"];

        $user = get_user_by_id($_SESSION["user_id"]);

        if ($user["is_admin"]) {
            $success = update_user_admin_status($user_id, $is_admin);
            if ($success) {
                echo json_encode(["success" => true, "message" => "User's admin status updated successfully!", "is_admin" => $is_admin]);
            } else {
                echo json_encode(["success" => false, "message" => "An error occurred while updating the user's admin status."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "You are not authorized to perform this action."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Please provide user_id and is_admin fields."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>