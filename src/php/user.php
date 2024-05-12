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

function update_user_infos_by_id($user_id, $firstname, $lastname, $username, $phonenumber, $avatar)
{
    global $pdo;
    $query = 'UPDATE User 
              SET firstname = :firstname, lastname = :lastname,
                  username = :username, phone_number = :phonenumber,
                  icon = :avatar 
              WHERE id = :user_id
             ';

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':phonenumber', $phonenumber);
    $stmt->bindParam(':avatar', $avatar);

    $stmt->execute();

    return $stmt->rowCount() > 0;
}


function get_user_avatar($id_user)
{
    global $pdo;

    $query = "SELECT icon FROM User WHERE id = :id_user";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user['icon'];
}