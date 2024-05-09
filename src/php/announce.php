<?php
require '../php/pdo.php';

function get_filtered_announce($categories = [], $minPrice, $maxPrice)
{
    global $pdo;

    $categoryCondition = '';
    if (!empty($categories)) {
        $categoryPlaceholders = implode(',', array_fill(0, count($categories), '?'));
        $categoryCondition = "AND id_category IN ($categoryPlaceholders)";
    }

    $query = "SELECT * FROM Announce 
              WHERE 1=1
              $categoryCondition
              AND price >= :minPrice 
              AND price <= :maxPrice";

    $stmt = $pdo->prepare($query);

    // Bind category IDs
    foreach ($categories as $key => $category) {
        $stmt->bindValue($key + 1, $category, PDO::PARAM_INT);
    }

    $stmt->bindParam(':minPrice', $minPrice);
    $stmt->bindParam(':maxPrice', $maxPrice);

    $stmt->execute();
    $announce = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $announce;
}



function get_all_announce()
{
    global $pdo;

    $query = "SELECT * FROM Announce";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $announce = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $announce;
}

function generate_star($rating)
{
    $stars = "";
    for ($i = 0; $i < 5; $i++) {
        if ($i < $rating) {
            $stars .= "<i class='fa fa-star checked'></i>";
        } else {
            $stars .= "<i class='fa fa-star'></i>";
        }
    }
    return $stars;
}

function display_announce($announce)
{
    foreach ($announce as $row) {
        echo "<div class='announce'>";
        echo "<img src='../public/patate.png' alt='product'>";
        echo "<div class='infos'>";
        echo "<div class='details'>";
        echo "<h4>" . $row['title'] . "</h4>";
        echo "<span class='price'>" . $row['price'] . "€</span>";
        echo "<span class='rating '>";
        echo generate_star($row['rating']);
        echo "</span>";
        echo "</div>";
        echo "<div class='actions'>";
        echo "<button class='cart'><i class='fa fa-shopping-cart'></i></button>";
        echo "<button class='wish'><i class='fa fa-heart'></i></button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}

?>