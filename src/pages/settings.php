<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovia - Home</title>

    <script src="../scripts/theme.js"></script>

    <link rel="stylesheet" href="../styles/dashboard.css" onload="load_theme()">
    <link rel="stylesheet" href="../styles/main-header.css">
    <link rel="stylesheet" href="../styles/settings.css">
    <link rel="stylesheet" href="../styles/alert.css">
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

            <a href="../pages/settings.php" class="active">
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

        <section class="tab-content user-section">

            <div class="content">
                <h3>Account Setting</h3>
                <hr>

                <div class="user-details">
                    <div class="setting">
                        <form id="user-infos-form" action="../php/update-user-infos.php" method="POST"
                            enctype="multipart/form-data">
                            <div class="input-infos">
                                <label for="firstname">First name</label>
                                <input type="text" name="firstname" id="firstname"
                                    value="<?php echo $user['firstname']; ?>" required>
                            </div>

                            <div class="input-infos">
                                <label for="lastname">Last name</label>
                                <input type="text" name="lastname" id="lastname"
                                    value="<?php echo $user['lastname']; ?>" required>
                            </div>

                            <div class="input-infos">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username"
                                    value="<?php echo $user['username']; ?>" required>
                            </div>
                            <div class="input-infos">
                                <label for="phonenumber">Phone Number</label>
                                <input type="text" name="phonenumber" id="phonenumber"
                                    value="<?php echo $user['phone_number']; ?>" required>
                            </div>

                            <button type="submit">Save Changes</button>
                        </form>
                    </div>

                    <div class="user-image">
                        <img id="user-image" src="<?php echo $user['icon']; ?>" alt="user-image">
                        <button onclick="document.getElementById('file-input').click()">Change Image</button>
                        <input form="user-infos-form" type="file" name="avatar" id="file-input" style="display: none;"
                            onchange="update_image()">
                    </div>
                </div>
            </div>

            <div class="change-password">
                <h3>Change Password</h3>
                <hr>
                <form id="password-form" action="../php/update-user-password.php" method="POST">
                    <div class="input-infos">
                        <label for="old-password">Old Password</label>
                        <input type="password" name="old-password" id="old-password" required>
                    </div>

                    <div class="group">
                        <div class="input-infos">
                            <label for="new-password">New Password</label>
                            <input type="password" name="new-password" id="new-password" required>
                        </div>

                        <div class="input-infos">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" name="confirm-password" id="confirm-password" required>
                        </div>
                    </div>

                    <button type="submit">Change Password</button>
                </form>
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

    <script src="../scripts/settings.js"></script>
    <script src="../scripts/announce-operation.js"></script>
    <script src="../scripts/alert.js"></script>
</body>

<div id="custom-alert" class="custom-alert"></div>


</html>