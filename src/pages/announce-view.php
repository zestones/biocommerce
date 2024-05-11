<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovia</title>

    <script src="../../scripts/theme.js"></script>

    <link rel="stylesheet" href="../../styles/announce.css" onload="load_theme()">
    <link rel="stylesheet" href="../../styles/main-header.css">
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
            <a href="../../pages/user/wishlist.html">
                <i class="fa fa-heart"></i>
            </a>

            <a href="../../pages/user/cart.html">
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
        ?>

        <section class="gallery">
            <?php
            display_gallery($_GET['id']);
            ?>
        </section>

        <section class="quick-view">

            <div class="main-infos">
                <h1><?php echo $announce['title'] ?></h1>

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
                    <button class="increment" onclick="decrement()">-</button>
                    <span id="count">0</span>
                    <button class="decrement" onclick="increment()">+</button>
                </div>

                <button class="cart">Add to Cart<i class="fa fa-shopping-cart"></i></button>
                <button class="wish" onclick="add_wishlist_item(<?php echo $_GET['id'] ?>)">
                    <i class="fa fa-heart" id="<?php echo $_GET['id'] ?>-wish-icon" style="<?php if ($is_in_wishlist)
                           echo "color: var(--secondary);" ?>"></i>
                    </button>
                </div>

                <hr>

                <div class="category">
                    <span>
                        <strong>Category:</strong>
                    <?php echo "<span>" . $category['name'] . "</span>" ?>
                </span>
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

    <script src="../scripts/announce-operation.js"></script>
    <script src="../scripts/announce.js"></script>
</body>

</html>