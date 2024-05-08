<?php
require '../php/pdo.php';

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
        echo "<span>" . $row['price'] . "€</span>";
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