<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BioCommerce - Home</title>

    <script src="../scripts/theme.js"></script>

    <link rel="stylesheet" href="../styles/alert.css">
    <link rel="stylesheet" href="../styles/footer.css">

    <link rel="stylesheet" href="../styles/home.css" onload="load_theme()">
    <link rel="stylesheet" href="../styles/main-header.css">
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

    <div class="container-options">
        <span class="create-announce">
            <a href="../pages/create-announce.php" class="create-announce-btn" onclick="createAnnounce()">
                Create Announce <i class="fa fa-plus"></i>
            </a>
        </span>

        <div class="centered-options">
            <div class="sort">
                <button class="sort-btn" onclick="toggleSort()">
                    Sort <i class="fa fa-sort"></i>
                </button>

                <div class="sort-section">
                    <button onclick="sort('price')">Price</button>
                    <button onclick="sort('rating')">Rating</button>
                </div>
            </div>

            <div class="number-results">
                <span id="number-results">(10)</span>
                <span>Results Found</span>
            </div>

            <div class="view-section">
                <button onclick="view('grid')">
                    <i class="fa fa-th"></i>
                </button>
                <button onclick="view('list')">
                    <i class="fa fa-list"></i>
                </button>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="filter">
            <div class="categories-section">

                <h3>All Categories</h3>
                <div class="categories">
                    <?php
                    require '../php/category.php';
                    session_start();

                    $categories = get_all_categories();
                    display_categories($categories);
                    ?>
                </div>
            </div>

            <hr class="separator">

            <div class="price-section">
                <h3>Price Range</h3>
                <div class="slide-container">
                    <div class="slider-track"></div>
                    <input type="range" min="0" max="30" value="0" id="slider-1" oninput="slideOne()">
                    <input type="range" min="0" max="30" value="30" id="slider-2" oninput="slideTwo()">
                </div>

                <div class="values">
                    <span>Price: </span>
                    <strong>
                        <span id="range1">0€</span>
                        <span> &dash; </span>
                        <span id="range2">30€</span>
                    </strong>

                </div>
            </div>
        </div>

        <div class="announce-section">
            <?php
            require '../php/announce.php';
            $announce = get_all_announce();

            display_announce($announce);
            ?>
        </div>

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

    <script src="../scripts/announce-operation.js"></script>
    <script src="../scripts/slider.js"></script>
    <script src="../scripts/home.js"></script>
    <script src="../scripts/alert.js"></script>
</body>

<div id="custom-alert" class="custom-alert"></div>

</html>