<?php
require '../php/pdo.php';

function get_all_categories()
{
    global $pdo;

    $query = "SELECT * FROM Category";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function display_categories($categories)
{
    foreach ($categories as $category) {

        echo "<span>";
        echo "<input type='checkbox' id='" . $category['id'] . "-category' name='category' value='" . $category['name'] . "'>";
        echo "<label for='" . $category['name'] . "'>" . $category['name'] . "</label>";
        echo "</span>";
    }
}

?>