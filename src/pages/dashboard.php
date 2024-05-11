<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovia - Home</title>

    <script src="../../scripts/theme.js"></script>

    <link rel="stylesheet" href="../../styles/dashboard.css" onload="load_theme()">
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
    <?php
    require "../php/user.php";
    session_start();
    $user = get_user_by_id($_SESSION['user_id']);
    ?>

    <div class="main-container">
        <section class="navigation">
            <h3>Navigation</h3>
            <a href="../pages/dashboard.php" class="active">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>

            <a href="../pages/wishlist.php">
                <i class="fa fa-heart"></i>
                <span>Wishlist</span>
            </a>

            <a href="../pages/cart.php">
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
            <h3 class="section-title">Profile</h3>
            <div class="profile-container">
                <div class="profile-image">
                    <img src="<?php echo $user["icon"]; ?>" alt="profile-image">
                    <div class="info">
                        <span class="info-value"><?php echo $user["username"]; ?></span>
                        <a href="../pages/settings.php" class="edit-profile-link">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <div class="profile-details">
                    <div class="info">
                        <span class="info-value">
                            <?php echo $user["firstname"]; ?>
                            &nbsp;
                            <?php echo $user["lastname"]; ?>
                        </span>
                    </div>

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
                        <span class="info-value"><?php echo $user["phone_number"]; ?></span>
                    </div>
                </div>
            </div>
        </section>

    </div>

</body>

</html>