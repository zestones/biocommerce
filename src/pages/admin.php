<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovia - Home</title>

    <script src="../scripts/theme.js"></script>

    <link rel="stylesheet" href="../styles/dashboard.css" onload="load_theme()">
    <link rel="stylesheet" href="../styles/main-header.css">
    <link rel="stylesheet" href="../styles/wishlist.css">
    <link rel="stylesheet" href="../styles/alert.css">
    <link rel="stylesheet" href="../styles/confirm-modal.css">
    <link rel="stylesheet" href="../styles/admin.css">
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
    session_start();
    $user = get_user_by_id($_SESSION['user_id']);
    $all_users = get_all_users();
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
                echo '<a href="../pages/admin.php" class="active">
                            <i class="fa fa-user"></i>
                            <span>Admin</span>
                      </a>';
            }
            ?>

            <a href="../php/log-out.php">
                <i class="fa fa-sign-out"></i>
                <span>Log-out</span>
            </a>
        </section>

        <section class="tab-content admin-section">
            <table>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Administator</th>
                    <th></th>
                </tr>
                <?php foreach ($all_users as $user): ?>
                    <tr id="user-item-<?php echo $user['id']; ?>">
                        <td class="username">
                            <img src="<?php echo $user['icon']; ?>" alt="<?php echo $user['username']; ?>">
                            <span><?php echo $user['username']; ?></span>
                        </td>

                        <td>
                            <a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a>
                        </td>

                        <td>
                            <span>
                                <a href="tel:+<?php echo $user['phone_number']; ?>">
                                    <i class="fa fa-phone"></i>
                                    <?php echo $user['phone_number']; ?>
                                </a>
                            </span>
                        </td>

                        <td>
                            <label class="switch">
                                <input id="admin-switch-<?php echo $user['id']; ?>" 
                                type="checkbox" <?php echo $user["is_admin"] ? "checked" : ""; ?>
                                    onchange="update_admin_status(<?php echo $user['id']; ?>, this.checked)">
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td>
                            <button class="delete-btn" style="<?php echo $user['id'] == $_SESSION["user_id"] ? 'cursor: not-allowed; color: gray;' : ''; ?>" 
                            <?php if ($user['id'] != $_SESSION["user_id"]) { ?>
                                onclick="delete_user_account(<?php echo $user['id']; ?>)"
                            <?php } ?>>
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </button>
                        </td>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </div>

    <script src="../scripts/admin.js"></script>
    <script src="../scripts/announce-operation.js"></script>
    <script src="../scripts/alert.js"></script>
    <script src="../scripts/confirm.js"></script>
</body>

<div id="custom-alert" class="custom-alert"></div>

</html>