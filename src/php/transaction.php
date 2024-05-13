<?php

require '../php/pdo.php';

function insert_transaction($user_id, $announce_name, $quantity, $announce_price)
{
    global $pdo;

    $quey = "INSERT INTO UserTransaction (user_id, product_name, quantity, price)
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($quey);

    $stmt->bindParam(1, $user_id);
    $stmt->bindParam(2, $announce_name);
    $stmt->bindParam(3, $quantity);
    $stmt->bindParam(4, $announce_price);

    $stmt->execute();

    return $stmt->rowCount() > 0;
}

function get_latest_transaction($user_id, $limit)
{
    global $pdo;

    $query = "SELECT * FROM UserTransaction 
              WHERE user_id = ? 
              ORDER BY id DESC LIMIT ?
             ";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(1, $user_id);
    $stmt->bindParam(2, $limit);

    $stmt->execute();

    return $stmt->fetchAll();
}

function get_all_transaction($user_id)
{
    global $pdo;
    $query = "SELECT * FROM UserTransaction WHERE user_id = ?";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(1, $user_id);
    $stmt->execute();

    return $stmt->fetchAll();
}