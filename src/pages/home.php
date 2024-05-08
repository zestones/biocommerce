<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovia - Home</title>

    <script src="../../scripts/theme.js"></script>

    <link rel="stylesheet" href="../../styles/home.css" onload="load_theme()">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header>
        <a href="#"><img src="../../assets/logo/agrovia-green.png" alt="logo"></a>
        <div class="search-bar">
            <form action="../../php/search-product.php">
                <span>
                    <i class="fa fa-search"></i>
                    <input type="text" name="search" id="search" placeholder="Search for products">
                </span>

                <button type="submit">Search</button>
            </form>
        </div>

        <!-- wishlist/cart/user -->
        <div class="user">
            <a href="../../pages/user/wishlist.html">
                <i class="fa fa-heart"></i>
            </a>

            <a href="../../pages/user/cart.html">
                <i class="fa fa-shopping-cart"></i>
            </a>

            <a href="../../pages/user/user.html">
                <i class="fa fa-user"></i>
            </a>
        </div>
    </header>

    <div class="separator-background"></div>

    <div class="container">

        <div class="filter">
            <button class="filter-btn" onclick="toggleDropdown()">
                Filter <i class="fa fa-filter"></i>
            </button>
            <div class="categories-section">

                <h3>All Categories</h3>
                <div class="categories">
                    <span>
                        <input type="checkbox" id="fruits" name="category" value="fruits">
                        <label for="fruits">Fruits</label>
                    </span>

                    <span>
                        <input type="checkbox" id="vegetables" name="category" value="vegetables">
                        <label for="vegetables">Vegetables</label>
                    </span>

                    <span>
                        <input type="checkbox" id="dairy" name="category" value="dairy">
                        <label for="dairy">Dairy</label>
                    </span>

                    <span>
                        <input type="checkbox" id="meat" name="category" value="meat">
                        <label for="meat">Meat</label>
                    </span>

                    <span>
                        <input type="checkbox" id="fish" name="category" value="fish">
                        <label for="fish">Fish</label>
                    </span>

                    <span>
                        <input type="checkbox" id="bakery" name="category" value="bakery">
                        <label for="bakery">Bakery</label>
                    </span>

                    <span>
                        <input type="checkbox" id="cereals" name="category" value="cereals">
                        <label for="cereals">Cereals</label>
                    </span>

                    <span>
                        <input type="checkbox" id="spices" name="category" value="spices">
                        <label for="spices">Spices</label>
                    </span>

                    <span>
                        <input type="checkbox" id="drinks" name="category" value="drinks">
                        <label for="drinks">Drinks</label>
                    </span>

                    <span>
                        <input type="checkbox" id="others" name="category" value="others">
                        <label for="others">Others</label>
                    </span>
                </div>
            </div>

            <hr class="separator">

            <div class="price-section">
                <h3>Price Range</h3>
                <div class="slide-container">
                    <div class="slider-track"></div>
                    <input type="range" min="0" max="100" value="30" id="slider-1" oninput="slideOne()">
                    <input type="range" min="0" max="100" value="70" id="slider-2" oninput="slideTwo()">
                </div>

                <div class="values">
                    <span>Price: </span>
                    <span id="range1">0</span>
                    <span> &dash; </span>
                    <span id="range2">100</span>
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
</body>

<script src="../../scripts/slider.js"></script>
<script src="../../scripts/stars.js"></script>

</html>