<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovia - Home</title>

    <script src="../scripts/theme.js"></script>
    <link rel="stylesheet" href="../styles/alert.css">
    <link rel="stylesheet" href="../styles/dashboard.css" onload="load_theme()">
    <link rel="stylesheet" href="../styles/main-header.css">
    <link rel="stylesheet" href="../styles/shopping-cart.css">
    <link rel="stylesheet" href="../styles/wishlist.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    require "../php/security.php";
    redirect_not_registered_user();
    ?>

    <header>
        <a href="../pages/home.php"><img src="../assets/logo/agrovia-green.png" alt="logo"></a>
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
            <a href="../pages/user/wishlist.html">
                <i class="fa fa-heart"></i>
            </a>

            <a href="../pages/user/cart.html">
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
    $shopping_cart_announce = get_shopping_cart_by_user_id($_SESSION['user_id']);
    $total_price = 0;
    ?>

    <div class="main-container">
        <section class="navigation">
            <h3>Navigation</h3>
            <a href="../pages/dashboard.php">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>

            <a href="../pages/wishlist.php">
                <i class="fa fa-heart"></i>
                <span>Wishlist</span>
            </a>

            <a href="../pages/shopping-cart.php" class="active">
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

        <section class="tab-content shopping-cart-section">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
                <?php foreach ($shopping_cart_announce as $item): ?>
                    <tr id="wishlist-item-<?php echo $item['id']; ?>">
                        <td class="product">
                            <!-- Display product image -->
                            <img src="<?php echo $item['image']; ?>" alt="product">
                            <span><?php echo $item['title']; ?></span>
                        </td>
                        <td id="price-<?php echo $item['id']; ?>">
                            <?php echo $item['price']; ?>€
                        </td>
                        <td class="stock-status">
                            <span>
                                <div class="manage-quantity">
                                    <button class="increment" onclick="decrement(<?php echo $item['id']; ?>)">-</button>
                                    <span
                                        id="count-<?php echo $item['id']; ?>"><?php echo $item['quantity_selected']; ?></span>
                                    <button class="decrement" onclick="increment(<?php echo $item['id']; ?>)">+</button>
                                </div>
                            </span>
                        </td>
                        <td>
                            <strong class="subtotal" id="subtotal-<?php echo $item['id']; ?>">
                                <?php echo $item['price'] * $item['quantity_selected']; ?>€
                            </strong>
                        </td>
                        <td>
                            <!-- Delete button -->
                            <button class="delete-btn" onclick="delete_wishlist_item(<?php echo $item['id']; ?>)">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    <?php
                    $total_price += $item['price'] * $item['quantity_selected'];
                endforeach;
                ?>
            </table>
            <section class="total">
                <h3>Cart Total</h3>
                <span class="subtotal-price">
                    Subtotal: <span class="total-price"><?php echo $total_price; ?>€</span>
                </span>
                <hr>
                <span class="shipping-price">
                    Shipping: <span>Free</span>
                </span>
                <hr>
                <span>
                    Total: <span class="total-price"><?php echo $total_price; ?>€</span>
                </span>
                <button class="buy" onclick="">Buy</button>
                <button class="update" id="update-cart" onclick="update_cart();">Update Cart</button>
            </section>
        </section>

    </div>

    <script src="../scripts/announce-operation.js"></script>
    <script src="../scripts/alert.js"></script>
</body>

<div id="custom-alert" class="custom-alert"></div>

</html>