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
    <link rel="stylesheet" href="../styles/my-announces.css">
    <link rel="stylesheet" href="../styles/confirm-modal.css">
    <link rel="stylesheet" href="../styles/wishlist.css">
    <link rel="stylesheet" href="../styles/footer.css">
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
    $user_announces = get_user_announces_by_id($_SESSION['user_id']);
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

            <a href="../pages/my-announces.php" class="active">
                <i class="fa fa-bullhorn"></i>
                <span>My Announces</span>
            </a>

            <a href="../pages/wishlist.php">
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

        <section class="tab-content my-announces-section">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Edit</th>
                    <th></th>
                </tr>
                <?php foreach ($user_announces as $item): ?>
                    <tr id="wishlist-item-<?php echo $item['id']; ?>">
                        <td class="product">
                            <img src="<?php echo $item['image']; ?>" alt="product">
                            <span class="title"><?php echo $item['title']; ?></span>
                        </td>
                        <td class="price" id="price-<?php echo $item['id']; ?>">
                            <?php echo $item['price']; ?>€
                        </td>
                        <td class="stock-status">
                            <span>
                                <span class="quantity"
                                    id="count-<?php echo $item['id']; ?>"><?php echo $item['quantity']; ?></span>
                            </span>
                        </td>
                        <td>
                            <button class="edit-btn" onclick="open_edit_announce_modal(
                                            <?php echo $item['id']; ?>,
                                            '<?php echo $item['title']; ?>',
                                            '<?php echo $item['description']; ?>',
                                            <?php echo $item['price']; ?>,
                                            <?php echo $item['quantity']; ?>
                            )">
                                Edit <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>

                        </td>
                        <td>
                            <button class="delete-btn" onclick="delete_announce(<?php echo $item['id']; ?>)">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    <?php
                    $total_price += $item['price'] * $item['quantity_selected'];
                endforeach;
                ?>
            </table>

            <div id="edit-announce-modal" class="modal">
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

    <div class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <a href="../pages/home.php"><img src="../assets/logo/agrovia-green.png" alt="Agrovia logo"></a>
                <p>Agrovia is committed to providing high-quality agricultural products and services.</p>
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

    <script src="../scripts/my-announce.js"></script>
    <script src="../scripts/alert.js"></script>
    <script src="../scripts/confirm.js"></script>
</body>

<div id="custom-alert" class="custom-alert"></div>

</html>