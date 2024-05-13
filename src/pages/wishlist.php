<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovia - Home</title>

    <script src="../../scripts/theme.js"></script>
    <link rel="stylesheet" href="../styles/alert.css">
    <link rel="stylesheet" href="../../styles/dashboard.css" onload="load_theme()">
    <link rel="stylesheet" href="../../styles/main-header.css">
    <link rel="stylesheet" href="../../styles/wishlist.css">
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
    <?php
    require "../php/user.php";
    require "../php/announce.php";
    session_start();
    $user = get_user_by_id($_SESSION['user_id']);
    $wishlist_announce = get_wishlist_by_user_id($_SESSION['user_id']);
    ?>

    <div class="main-container">
        <section class="navigation">
            <h3>Navigation</h3>
            <a href="../pages/dashboard.php">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>

            <a href="../pages/my-announces.php">
                <i class="fa fa-bullhorn"></i>
                <span>My Announces</span>
            </a>

            <a href="../pages/wishlist.php" class="active">
                <i class="fa fa-heart"></i>
                <span>Wishlist</span>
            </a>

            <a href="../pages/shopping-cart.php">
                <i class="fa fa-shopping-cart"></i>
                <span>Shopping Cart</span>
            </a>

            <a href="../pages/settings.php">
                <i class="fa fa-gear"></i>
                <span>Settings</span>
            </a>

            <?php
            if ($user['is_admin']) {
                echo '<a href="../pages/admin.php"><i class="fa fa-user"></i><span>Admin</span></a>';
            }
            ?>

            <a href="../php/log-out.php">
                <i class="fa fa-sign-out"></i>
                Log-out
            </a>
        </section>

        <section class="tab-content wishlist-section">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Stock Status</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($wishlist_announce as $item): ?>
                    <tr id="wishlist-item-<?php echo $item['id']; ?>">
                        <td class="product">
                            <img src="<?php echo $item['image']; ?>" alt="product">
                            <span><?php echo $item['title']; ?></span>
                        </td>
                        <td><?php echo $item['price']; ?>€</td>
                        <td class="stock-status">
                            <span
                                class="stock-status <?php echo $item['out_of_stock'] == 0 ? 'in-stock' : 'out-of-stock'; ?>">
                                <?php
                                if ($item['out_of_stock'] == 0) {
                                    echo 'In stock';
                                } else {
                                    echo 'Out of stock';
                                }
                                ?>
                                <?php echo $item['out_of_stock'] ?>
                            </span>
                        </td>
                        <td>
                            <!-- Add to cart button add clas if out of stock-->
                            <button class="cart-btn <?php echo $item['out_of_stock'] == 1 ? 'out-of-stock' : ''; ?>"
                                onclick="move_announce_to_cart(<?php echo $item['id']; ?>)">
                                Add to cart
                            </button>
                        </td>
                        <td>
                            <!-- Delete button -->
                            <button class="delete-btn" onclick="delete_wishlist_item(<?php echo $item['id']; ?>)">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>

    </div>

    <script src="../scripts/alert.js"></script>
    <script src="../scripts/announce-operation.js"></script>
</body>

<div id="custom-alert" class="custom-alert"></div>

</html>