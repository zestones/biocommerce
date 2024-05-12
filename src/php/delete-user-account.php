<?php
require "../php/user.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postData = file_get_contents("php://input");
    $requestData = json_decode($postData, true);

    if (
        isset($requestData["user_id"]) &&
        !empty($requestData["user_id"])
    ) {
        $user_id = $requestData["user_id"];
        $user = get_user_by_id($_SESSION["user_id"]);

        if ($user["is_admin"]) {
            $success = delete_user_account($user_id);
            if ($success) {
                echo json_encode(["success" => true, "message" => "User's account has been deleted."]);
            } else {
                echo json_encode(["success" => false, "message" => "An error occurred while deleting user's account."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "You are not authorized to perform this action."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Please provide user's ID."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>