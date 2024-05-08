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

function display_announce($announce)
{
    foreach ($announce as $row) {
        echo "<div class='product'>";
        echo "<img src='../../assets/products/" . $row['image'] . "' alt='product'>";
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>Price: " . $row['price'] . "€</p>";
        echo "<button>Add to cart</button>";
        echo "</div>";
    }
}

?>