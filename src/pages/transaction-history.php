<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovia</title>

    <script src="../../scripts/theme.js"></script>

    <link rel="stylesheet" href="../../styles/dashboard.css" onload="load_theme()">
    <link rel="stylesheet" href="../../styles/transaction.css">
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
    $latest_transaction = get_all_transaction($_SESSION['user_id']);
    ?>

    <div class="main-container">
        <section class="navigation">
            <h3>Navigation</h3>
            <a href="../pages/dashboard.php">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>

            <a href="../pages/transaction-history.php" class="active">
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

        <section class="tab-content">
            <div class="transaction-section">
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

</body>

</html>