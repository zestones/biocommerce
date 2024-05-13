<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovia - Home</title>

    <script src="../../scripts/theme.js"></script>

    <link rel="stylesheet" href="../../styles/dashboard.css" onload="load_theme()">
    <link rel="stylesheet" href="../../styles/main-header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    require "../php/security.php";
    redirect_not_registered_user();
    ?>

    <header>
        <a href="../pages/home.php"><img id="logo" src="../assets/logo/agrovia-green.png" alt="logo"></a>
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
    <?php
    require "../php/user.php";
    require "../php/transaction.php";

    session_start();
    $user = get_user_by_id($_SESSION['user_id']);
    $latest_transaction = get_latest_transaction($_SESSION['user_id'], 6);
    ?>

    <div class="main-container">
        <section class="navigation">
            <h3>Navigation</h3>
            <a href="../pages/dashboard.php" class="active">
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

        <section class="tab-content profile-section">
            <div class="profile-container">
                <div class="profile-image">
                    <img src="<?php echo $user["icon"]; ?>" alt="profile-image">
                    <div class="info">
                        <div class="name">
                            <span class="profile-name"><?php echo $user["firstname"]; ?></span>
                            <span class="profile-name"><?php echo $user["lastname"]; ?></span>
                        </div>

                        <span class="info-value"><?php echo $user["username"]; ?></span>
                        <a href="../pages/settings.php" class="edit-profile-link">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <div class="profile-details">
                    <div class="info">
                        <span class="info-names">
                            <?php echo $user["firstname"]; ?>
                            <?php echo $user["lastname"]; ?>
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <span class="info-label">Email:</span>
                            <span class="info-value">
                                <a href="mailto: <?php echo $user['email']; ?>">
                                    <?php echo $user['email']; ?>
                                </a>
                            </span>
                        </div>

                        <div class="info">
                            <span class="info-label">Phone Number:</span>
                            <span class="info-value">
                                <a href="tel:+<?php echo $user["phone_number"]; ?>">
                                    <?php echo $user["phone_number"]; ?>
                                </a>
                            </span>
                        </div>

                        <div class="admin-status"
                            style="<?php echo $user["is_admin"] ? "display: block" : "display: none" ?>">
                            <?php
                            if ($user["is_admin"]) {
                                echo '<span class="admin-label">Administrator</span>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="transaction-overview">
                <div class="transaction-header">
                    <h3>Recent Transactions</h3>
                    <a href="../pages/transaction-history.php">View All</a>
                </div>

                <div class="transaction">
                    <div class="transaction-item header">
                        <span class="column">Order ID</span>
                        <span class="column">Product</span>
                        <span class="column">Price (Quantity)</span>
                        <span class="column">Date</span>
                    </div>

                    <?php foreach ($latest_transaction as $transaction): ?>
                        <div class="transaction-item">
                            <span class="column">#<?= $transaction["id"] ?></span>
                            <span class="column"><?= $transaction["product_name"] ?></span>
                            <span class="column"><?= $transaction["price"] ?>€
                                (<?= $transaction["quantity"] ?> Products)</span>
                            <span class="column"><?= date("Y-m-d", strtotime($transaction["date"])) ?></span>
                        </div>
                    <?php endforeach; ?>
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

</body>

</html>