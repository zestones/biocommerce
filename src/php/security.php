<?php

function redirect_not_registered_user()
{
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../pages/login.html");
    }
}

?>