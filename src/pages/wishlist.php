<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BioCommerce - Home</title>

    <script src="../scripts/theme.js"></script>
    <link rel="stylesheet" href="../styles/alert.css">
    <link rel="stylesheet" href="../styles/dashboard.css" onload="load_theme()">
    <link rel="stylesheet" href="../styles/main-header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/wishlist.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    require "../php/security.php";
    redirect_not_registered_user();
    ?>

    <header>
        <a href="../pages/home.php"><img id="logo" src="../assets/logo/biocommerce-green.png" alt="logo"></a>
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
            <a href="../pages/wishlist.php">
                <i class="fa fa-heart"></i>
            </a>

            <a href="../pages/shopping-cart.php">
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

            <a href="../pages/transaction-history.php">
                <i class="fa fa-history"></i>
                <span>Transaction History</span>
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
                                </span>
                            </td>
                            <td>
                                <!-- Add to cart button add class if out of stock-->
                                <?php if ($item['out_of_stock'] == 0): ?>
                                        <button class="cart-btn" onclick="move_announce_to_cart(<?php echo $item['id']; ?>)">
                                            Add to cart
                                        </button>
                                <?php else: ?>
                                        <button class="cart-btn out-of-stock">
                                            Out of stock
                                        </button>
                                <?php endif; ?>
                            </td>
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

    <div class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <a href="../pages/home.php"><img src="../assets/logo/biocommerce-green.png" alt="BioCommerce logo"></a>
                <p>BioCommerce is committed to providing high-quality agricultural products and services.</p>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <a href="../pages/home.php">Home</a>
                <a href="../pages/create-announce.php">Create Announce</a>
                <a href="../pages/settings.php">Settings</a>
                <a href="../pages/login.php">Login</a>
                <a href="../php/log-out.php">Log-out</a>
            </div>

            <div class="footer-section">
                <h3>Account</h3>
                <a href="../pages/dashboard.php">My Account</a>
                <a href="../pages/my-announces.php">My Announces</a>
                <a href="../pages/wishlist.php">My Wishlist</a>
                <a href="../pages/shopping-cart.php">My Shopping Cart</a>
                <a href="../pages/transaction-history.php">My Transaction History</a>

            </div>
        </div>
    </div>

    <script src="../scripts/alert.js"></script>
    <script src="../scripts/announce-operation.js"></script>
</body>

<div id="custom-alert" class="custom-alert"></div>

</html>