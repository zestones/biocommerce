<?php
require '../php/pdo.php';


function get_user_by_id($id_user)
{
    global $pdo;

    $query = "SELECT * FROM User WHERE id = :id_user";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}