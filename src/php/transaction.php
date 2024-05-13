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