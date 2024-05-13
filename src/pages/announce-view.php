<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovia</title>

    <script src="../../scripts/theme.js"></script>

    <link rel="stylesheet" href="../../styles/announce.css" onload="load_theme()">
    <link rel="stylesheet" href="../../styles/main-header.css">
    <link rel="stylesheet" href="../styles/confirm-modal.css">
    <link rel="stylesheet" href="../styles/alert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    require "../php/security.php";
    redirect_not_registered_user();
    ?>

    <header>
        <a href="../pages/home.php"><img src="../../assets/logo/agrovia-green.png" alt="logo"></a>
        <div class="search-bar">
            <span>
                <i class="fa fa-search"></i>
                <input type="text" name="search" id="search" placeholder="Search for products"
                    onkeydown="if(event.keyCode === 13) search()">
            </span>
            </span>

            <button onclick="search()">Search</button>
        </div>

        <!-- wishlist/cart/user -->
        <div class="user">
            <a href="../../pages/wishlist.php">
                <i class="fa fa-heart"></i>
            </a>

            <a href="../../pages/shopping-cart.php">
                <i class="fa fa-shopping-cart"></i>
            </a>

            <a href="../pages/dashboard.php">
                <i class="fa fa-user"></i>
            </a>
        </div>
    </header>

    <div class="separator-background"></div>

    <div class="main-container">
        <?php
        require "../php/announce.php";
        session_start();

        $announce = get_announce_by_id($_GET['id']);
        $category = get_announce_category($_GET['id']);
        $is_in_wishlist = is_announce_in_wish_list($_GET['id']);
        $is_in_cart = is_announce_in_cart($_GET['id']);
        $is_user_owner = is_announce_owned_by_user($_GET['id'], $_SESSION['user_id']);
        ?>

        <section class="gallery">
            <?php
            display_gallery($_GET['id']);
            ?>
        </section>

        <section class="quick-view" id="my-announce-quick-view">

            <div class="main-infos">
                <div class="top-infos">
                    <h1 class="title"><?php echo $announce['title'] ?></h1>
                    <div class="more-button" onclick="toggleAdminActions()">
                        <i class="fa fa-ellipsis-v"></i>
                    </div>
                    <div class="admin-action" id="admin-action-container" style="display: none;">
                        <?php
                        if (isset($_SESSION['user_id']) && $is_user_owner) {
                            echo '<button class="edit" onclick="open_edit_announce_modal(
                            ' . $announce['id'] . ',
                            \'' . $announce['title'] . '\',
                            \'' . $announce['description'] . '\',
                            ' . $announce['price'] . ',
                            ' . $announce['quantity'] . ')">
                            Edit
                            <i class="fa fa-pencil"></i>
                            </button>';
                        }
                        if ($is_user_owner || $_SESSION['is_admin']) {
                            echo '<button class="delete" onclick="delete_announce(' . $announce['id'] . ')">
                            Delete
                            <i class="fa fa-trash"></i>
                            </button>';
                        }
                        ?>
                    </div>
                </div>


                <div class="rating"><?php echo generate_star($announce['rating']) ?></div>
                <div class="price"><?php echo $announce['price'] ?>€</div>
            </div>
            <hr>

            <div class="description">
                <p><?php echo $announce['description'] ?></p>
            </div>

            <hr>

            <div class="actions">
                <div class="manage-quantity">
                    <button class="increment" onclick="decrement_quantity()">-</button>
                    <span id="count">0</span>
                    <button class="decrement"
                        onclick="increment_quantity(<?php echo $announce['quantity'] ?>)">+</button>
                </div>

                <button class="cart" id="button-cart-id" style="<?php if ($is_in_cart)
                    echo "background-color: rgba(45, 45, 45, 0.20); border: 2px solid var(--light-stroke); " ?>"
                        onclick="add_cart_item_by_id(<?php echo $_GET['id'] ?>)">
                    Add to Cart
                    <i class="fa fa-shopping-cart"></i>
                </button>
                <button class="wish" onclick="add_wishlist_item(<?php echo $_GET['id'] ?>)">
                    <i class="fa fa-heart" id="<?php echo $_GET['id'] ?>-wish-icon" style="<?php if ($is_in_wishlist)
                           echo "color: var(--secondary);" ?>">
                        </i>
                    </button>
                </div>

                <hr>

                <div class="category">
                    <span>
                        <strong>Category:</strong>
                    <?php echo "<span>" . $category['name'] . "</span>" ?>
                </span>
                <span>
                    <strong>Quantity:</strong>
                    <?php echo "<span class='quantity'>" . $announce['quantity'] . "</span>" ?>
                </span>
            </div>



            <div id="edit-announce-modal" class="edit-modal">
                <div class="modal-content">
                    <span class="close" onclick="close_edit_announce_modal()">&times;</span>
                    <h2>Edit Announce</h2>

                    <form id="edit-announce-form" action="../php/update-announce.php" method="POST">
                        <div class="form-group">
                            <label for="edit-title">Title:</label>
                            <input type="text" id="edit-title" name="edit-title">
                        </div>
                        <div class="form-group">
                            <label for="edit-description">Description:</label>
                            <textarea id="edit-description" name="edit-description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit-price">Price:</label>
                            <input type="number" id="edit-price" name="edit-price" min="0" step="0.01">
                        </div>
                        <div class="form-group">
                            <label for="edit-quantity">Quantity:</label>
                            <input type="number" id="edit-quantity" name="edit-quantity" min="0">
                        </div>
                        <button id="save-btn" class="save-btn" type="button"
                            onclick="save_edited_announce(this.id)">Save</button>
                    </form>
                </div>
            </div>

        </section>
    </div>

    <h2 class="title-feedback">Customer Feedback</h2>
    <hr class="feedback-separator">
    <div class="customer-feedback">
        <section class="feedback-section">
            <?php
            require "../php/feedback.php";
            $feedback = get_feedback_by_announce_id($_GET['id']);
            display_feedback($feedback);
            ?>
        </section>

        <section class="add-feedback">
            <h3>Add your feedback</h3>
            <div class="rating-stars">
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
            </div>
            <textarea name="feedback" id="feedback" cols="30" rows="10"
                placeholder="Write your feedback here..."></textarea>
            <button onclick="submit_feedback()">Submit</button>
        </section>
    </div>

    <script src="../scripts/announce.js"></script>
    <script src="../scripts/announce-operation.js"></script>
    <script src="../scripts/my-announce.js"></script>
    <script src="../scripts/alert.js"></script>
    <script src="../scripts/confirm.js"></script>
</body>

<div id="custom-alert" class="custom-alert"></div>

</html>