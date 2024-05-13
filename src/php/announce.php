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
    $image = $images[0] == '' ? "../public/no-image-available.jpg" : $images[0];
    $stmt->bindParam(1, $category_id);
    $stmt->bindParam(2, $image);
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

    // Insert the announce into the UserAnnounce table
    $stmt = $pdo->prepare("INSERT INTO UserAnnounce (user_id, announce_id) VALUES (?, ?)");
    $stmt->bindParam(1, $_SESSION["user_id"]);
    $stmt->bindParam(2, $announce_id);
    $stmt->execute();
}

function update_user_announce_by_id($id, $title, $description, $price, $quantity)
{
    global $pdo;

    $out_of_stock = $quantity == 0 ? 1 : 0;
    $query = "UPDATE Announce 
              SET title = :title,
                  description = :description,
                  price = :price,
                  quantity = :quantity,
                  out_of_stock = :out_of_stock
              WHERE id = :id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':out_of_stock', $out_of_stock);

    $stmt->execute();

    return $stmt->rowCount() > 0;
}

function decrease_announce_quantity($announce_id, $announce_quantity)
{
    global $pdo;

    // Update quantity and determine new value of out_of_stock
    $query = 'UPDATE Announce 
              SET quantity = quantity - ?,
                  out_of_stock = (SELECT CASE WHEN (quantity - ?) <= 0 THEN 1 ELSE 0 END)
              WHERE id = ?
            ';

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $announce_quantity);
    $stmt->bindParam(2, $announce_quantity);
    $stmt->bindParam(3, $announce_id);

    $stmt->execute();

    return $stmt->rowCount() > 0;
}


function delete_announce_from_cart($announce_id, $user_id)
{
    global $pdo;

    $query = "UPDATE UserSaved
                SET is_in_cart = 0, quantity_selected = 0
                WHERE user_id = :user_id AND announce_id = :announce_id
              ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':announce_id', $announce_id);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

function delete_announce_by_id($announce_id)
{
    global $pdo;

    // We delete the announce from the Announce table
    $query = "DELETE FROM Announce WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $announce_id);
    $stmt->execute();

    // from the UserAnnounce table
    $query = "DELETE FROM UserAnnounce WHERE announce_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $announce_id);
    $stmt->execute();

    // from the UserSaved table
    $query = "DELETE FROM UserSaved WHERE announce_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $announce_id);
    $stmt->execute();

    // from the AnnounceImage table
    $query = "DELETE FROM AnnounceImage WHERE announce_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $announce_id);
    $stmt->execute();

    // User comments
    $query = "DELETE FROM AnnounceComment WHERE announce_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $announce_id);
    $stmt->execute();

    return $stmt->rowCount() > 0;
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

function get_saved_announce_by_user_id($user_id)
{
    global $pdo;

    $query = "SELECT * FROM UserSaved WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $announce = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $announce;
}

function is_announce_owned_by_user($announce_id, $user_id)
{
    global $pdo;

    $query = "SELECT COUNT(*) FROM UserAnnounce WHERE announce_id = :announce_id AND user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':announce_id', $announce_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    return $count > 0;
}


function get_user_announces_by_id($user_id)
{
    global $pdo;

    $query = "SELECT * FROM Announce WHERE id IN (SELECT announce_id FROM UserAnnounce WHERE user_id = :user_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $announce = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $announce;
}

function get_shopping_cart_by_user_id($user_id)
{
    global $pdo;

    $query = "SELECT Announce.*, UserSaved.quantity_selected
              FROM Announce
              JOIN UserSaved ON Announce.id = UserSaved.announce_id
              WHERE UserSaved.user_id = :user_id AND UserSaved.is_in_cart = 1
             ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $shopping_cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $shopping_cart;
}

function update_cart_quantity_by_announce_id($id, $quantity)
{
    global $pdo;

    $query = "UPDATE UserSaved SET quantity_selected = :quantity WHERE user_id = :user_id AND announce_id = :announce_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':announce_id', $id);
    $stmt->execute();

    return $stmt->rowCount() > 0;
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

function delete_saved_announce($announce_id)
{
    global $pdo;

    $query = "DELETE FROM UserSaved WHERE user_id = :user_id AND announce_id = :announce_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':announce_id', $announce_id);
    $stmt->execute();
}

function remove_announce_from_wishlist($id)
{
    global $pdo;

    $query = "UPDATE UserSaved SET is_in_favourite = 0 WHERE user_id = :user_id AND announce_id = :announce_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':announce_id', $id);
    $stmt->execute();
}

function remove_announce_from_shopping_cart($id)
{
    global $pdo;

    $query = "UPDATE UserSaved SET is_in_cart = 0 WHERE user_id = :user_id AND announce_id = :announce_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':announce_id', $id);
    $stmt->execute();
}

function is_announce_saved_by_user($announce_id)
{
    global $pdo;

    $query = "SELECT * FROM UserSaved WHERE user_id = :user_id AND announce_id = :announce_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':announce_id', $announce_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result !== false;
}

function get_saved_announce_by_id($announce_id)
{
    global $pdo;

    $query = "SELECT * FROM UserSaved WHERE user_id = :user_id AND announce_id = :announce_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':announce_id', $announce_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function move_announce_to_cart($announce_id)
{
    $quantity = 1;
    if (is_announce_saved_by_user($announce_id)) {
        $saved_announce = get_saved_announce_by_id($announce_id);
        if ($saved_announce["is_in_favourite"]) {
            remove_announce_from_wishlist($announce_id);
        }
        if ($saved_announce["is_in_cart"]) {
            $max_quantity = get_announce_by_id($announce_id)["quantity"];
            $quantity += $saved_announce["quantity_selected"];
            $quantity = min($quantity, $max_quantity);
        }
    }

    add_announce_to_shopping_cart($announce_id, $quantity);
}

function add_announce_to_shopping_cart($announce_id, $quantity)
{
    global $pdo;

    if (is_announce_saved_by_user($announce_id)) {
        $query = 'UPDATE UserSaved SET quantity_selected = :quantity, is_in_cart = 1
                  WHERE user_id = :user_id AND announce_id = :announce_id
                 ';

    } else {
        $query = "INSERT INTO UserSaved (user_id, announce_id, quantity_selected, is_in_cart, is_in_favourite)
                  VALUES (:user_id, :announce_id, :quantity, 1, 0)";
    }

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':announce_id', $announce_id);
    $stmt->bindParam(':quantity', $quantity);

    $stmt->execute();
}

function add_announce_to_wishlist($announce_id)
{
    global $pdo;

    if (is_announce_saved_by_user($announce_id)) {
        $query = 'UPDATE UserSaved SET is_in_favourite = 1 
                  WHERE user_id = :user_id AND announce_id = :announce_id';
    } else {
        $query = "INSERT INTO UserSaved (user_id, announce_id, quantity_selected, is_in_cart, is_in_favourite) 
                  VALUES (:user_id, :announce_id, 0, 0, 1)
                 ";
    }

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':announce_id', $announce_id);

    $stmt->execute();
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

function is_announce_in_cart($id)
{
    global $pdo;

    $query = "SELECT * FROM UserSaved 
              WHERE user_id = :user_id 
              AND announce_id = :announce_id
              AND is_in_cart = 1
             ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':announce_id', $id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result !== false;
}

function is_announce_in_wish_list($annouce_id)
{
    global $pdo;

    $query = "SELECT * FROM UserSaved 
              WHERE user_id = :user_id 
              AND announce_id = :announce_id
              AND is_in_favourite = 1
             ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':announce_id', $annouce_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result !== false;
}

function _get_announce_saved_by_user($announce, $saved_announce)
{
    foreach ($saved_announce as $saved_row) {
        if ($announce["id"] === $saved_row["announce_id"]) {
            return $saved_row;
        }
    }

    return false;
}

function display_announce($announce)
{
    $saved_announce = get_saved_announce_by_user_id($_SESSION['user_id']);
    foreach ($announce as $row) {
        $saved = _get_announce_saved_by_user($row, $saved_announce);
        echo "<a  
                  class='announce' id='" . $row['id'] . "-announce' 
                  href='../pages/announce-view.php?id=" . $row['id'] . "'";
        echo ">";

        $icon_style = "style='color: var(--secondary);'";
        if ($row['image'] != '') {
            echo "<img src='" . $row['image'] . "' alt='product'>";
        } else {
            echo "<img src='../public/no-image-available.jpg' alt='product'>";
        }

        if ($row['out_of_stock'] == 1) {
            echo "<div class='out-of-stock'>Out of stock</div>";
        } else {
            echo "<div class='in-stock'>In stock</div>";
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
        echo "<button class='cart'
                      onclick='event.preventDefault(); add_cart_item(" . $row['id'] . ")'>
                <i 
                    class='fa fa-shopping-cart'" . ($saved['is_in_cart'] == 1 ? $icon_style : '') . "
                    id='" . $row['id'] . "-cart-icon'    
                >
                    
                </i>
              </button>";

        echo "<button class='wish' 
                      onclick='event.preventDefault(); add_wishlist_item(" . $row['id'] . ")'
                >
                <i 
                    class='fa fa-heart'" . ($saved['is_in_favourite'] == 1 ? $icon_style : '') . "
                    id='" . $row['id'] . "-wish-icon'
                >
                </i>
              </button>";
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