<?php

session_start();

if (isset($_SESSION['user_id'])) {
    session_destroy();
    header('Location: ../pages/login.html');
} else {
    header('Location: ../pages/login.html');
}

?>