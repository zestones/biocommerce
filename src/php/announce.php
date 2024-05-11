<?php
require '../php/pdo.php';

function get_filtered_announce($categories = [], $keyword = '', $minPrice, $maxPrice)
{
    global $pdo;

    $categoryCondition = '';
    if (!empty($categories)) {
        $categoryPlaceholders = implode(',', array_fill(0, count($categories), '?'));
        $categoryCondition = "AND id_category IN ($categoryPlaceholders)";
    }

    $keywordCondition = '';
    if (!empty($keyword)) {
        $keywordCondition = "AND (title LIKE :keyword OR description LIKE :keyword)";
    }

    $query = "SELECT * FROM Announce 
              WHERE 1=1
              $categoryCondition
              $keywordCondition
              AND price >= :minPrice 
              AND price <= :maxPrice";

    $stmt = $pdo->prepare($query);

    // Bind category IDs
    foreach ($categories as $key => $category) {
        $stmt->bindValue($key + 1, $category, PDO::PARAM_INT);
    }

    // Bind keyword parameter if it's not empty
    if (!empty($keyword)) {
        $stmt->bindValue(':keyword', '%' . $keyword . '%');
    }

    $stmt->bindParam(':minPrice', $minPrice);
    $stmt->bindParam(':maxPrice', $maxPrice);

    $stmt->execute();
    $announce = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $announce;
}

function insert_announce($title, $description, $category_id, $price, $quantity, $images)
{
    global $pdo;

    // Prepare the SQL statement
    $stmt = $pdo->prepare("INSERT INTO Announce (id_category, image, title, description, price, quantity) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bindParam(1, $category_id);
    $stmt->bindParam(2, $images[0]);
    $stmt->bindParam(3, $title);
    $stmt->bindParam(4, $description);
    $stmt->bindParam(5, $price);
    $stmt->bindParam(6, $quantity);

    // Execute the statement
    $stmt->execute();

    // Get the ID of the newly inserted announce
    $announce_id = $pdo->lastInsertId();

    // Insert images into AnnounceImage table
    foreach ($images as $image) {
        $stmt = $pdo->prepare("INSERT INTO AnnounceImage (announce_id, image) VALUES (?, ?)");
        $stmt->bindParam(1, $announce_id);
        $stmt->bindParam(2, $image);
        $stmt->execute();
    }

    $stmt = $pdo->prepare("INSERT INTO UserAnnounce (user_id, announce_id) VALUES (?, ?)");
    $stmt->bindParam(1, $announce_id);
    $stmt->bindParam(2, $_SESSION["user_id"]);
    $stmt->execute();
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
function get_announce_by_id($id)
{
    global $pdo;

    $query = "SELECT * FROM Announce WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $announce = $stmt->fetch(PDO::FETCH_ASSOC);
    return $announce;
}

function get_announce_category($id_announce)
{
    global $pdo;

    $query = 'SELECT * FROM Category WHERE id IN (SELECT id_category FROM Announce WHERE id = :id_announce)';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_announce', $id_announce);
    $stmt->execute();

    $category = $stmt->fetch(PDO::FETCH_ASSOC);
    return $category;
}

function get_saved_announce($user_id)
{
    global $pdo;

    $query = "SELECT * FROM Announce WHERE id IN (SELECT announce_id FROM UserSaved WHERE user_id = :user_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $announce = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $announce;
}

function get_wishlist_by_user_id($user_id)
{
    global $pdo;

    $query = "SELECT Announce.* 
              FROM Announce 
              WHERE Announce.id IN (
                  SELECT announce_id FROM UserSaved 
                  WHERE user_id = :user_id 
                  AND is_in_favourite = 1
              )";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $wishlist = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $wishlist;
}


function get_announce_images_by_id($id)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT image FROM AnnounceImage WHERE announce_id = ?");
    $stmt->bindParam(1, $id);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $images = array_column($result, 'image');

    return $images;
}

function is_announce_in_wish_list($annouce_id)
{
    global $pdo;

    $query = "SELECT * FROM UserSaved WHERE user_id = :user_id AND announce_id = :announce_id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':announce_id', $annouce_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result !== false;
}

function _is_announce_saved_by_user($announce, $saved_announce)
{
    $is_saved = false;
    foreach ($saved_announce as $saved_row) {
        if ($announce["id"] === $saved_row["id"]) {
            $is_saved = true;
            break;
        }
    }

    return $is_saved;
}

function display_announce($announce)
{
    $saved_announce = get_saved_announce($_SESSION['user_id']);
    foreach ($announce as $row) {
        $is_saved = _is_announce_saved_by_user($row, $saved_announce);
        echo "<a  
                  class='announce' id='" . $row['id'] . "-announce' 
                  href='../pages/announce-view.php?id=" . $row['id'] . "'";
        if ($is_saved) {
            echo " style='border: 1px solid var(--secondary); box-shadow: 0 0 5px var(--secondary);'";
        }
        echo ">";

        if ($row['image'] != '') {
            echo "<img src='" . $row['image'] . "' alt='product'>";
        } else {
            echo "<img src='../public/no-image-available.jpg' alt='product'>";
        }

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
        echo "</a>";
    }
}

function display_gallery($announce_id)
{
    $images = get_announce_images_by_id($announce_id);

    for ($i = 0; $i < 4; $i++) {
        $image_path = $images[$i];

        echo '<div class="gallery-item">';
        echo '<input type="radio" id="img-' . ($i + 1) . '" ' . ($i === 0 ? 'checked' : '') . ' name="gallery" class="gallery-selector" />';

        if ($image_path == '') {
            $image_path = "../public/no-image-available.jpg";
        }

        echo '<img class="gallery-img" src="' . $image_path . '" alt="" />';
        echo '<label for="img-' . ($i + 1) . '" class="gallery-thumb"><img src="' . $image_path . '" alt="" /></label>';
        echo '</div>';
    }
}


?>