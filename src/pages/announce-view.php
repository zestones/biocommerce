<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovia</title>

    <script src="../../scripts/theme.js"></script>

    <link rel="stylesheet" href="../../styles/announce.css" onload="load_theme()">
    <link rel="stylesheet" href="../../styles/main-header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header>
        <a href="#"><img src="../../assets/logo/agrovia-green.png" alt="logo"></a>
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

            <a href="../../pages/user/user.html">
                <i class="fa fa-user"></i>
            </a>
        </div>
    </header>

    <div class="separator-background"></div>

    <div class="main-container">
        <?php
        require "../php/announce.php";
        $announce = get_announce_by_id($_GET['id']);
        $category = get_announce_category($_GET['id']);
        ?>

        <section class="gallery">
            <div class="gallery-item">
                <input type="radio" id="img-1" checked name="gallery" class="gallery-selector" />
                <img class="gallery-img" src="https://picsum.photos/id/1015/600/400.jpg" alt="" />
                <label for="img-1" class="gallery-thumb"><img src="https://picsum.photos/id/1015/150/100.jpg"
                        alt="" /></label>
            </div>
            <div class="gallery-item">
                <input type="radio" id="img-2" name="gallery" class="gallery-selector" />
                <img class="gallery-img" src="https://picsum.photos/id/1039/600/400.jpg" alt="" />
                <label for="img-2" class="gallery-thumb"><img src="https://picsum.photos/id/1039/150/100.jpg"
                        alt="" /></label>
            </div>
            <div class="gallery-item">
                <input type="radio" id="img-3" name="gallery" class="gallery-selector" />
                <img class="gallery-img" src="https://picsum.photos/id/1057/600/400.jpg" alt="" />
                <label for="img-3" class="gallery-thumb"><img src="https://picsum.photos/id/1057/150/100.jpg"
                        alt="" /></label>
            </div>
            <div class="gallery-item">
                <input type="radio" id="img-4" name="gallery" class="gallery-selector" />
                <img class="gallery-img" src="https://picsum.photos/id/106/600/400.jpg" alt="" />
                <label for="img-4" class="gallery-thumb"><img src="https://picsum.photos/id/106/150/100.jpg"
                        alt="" /></label>
            </div>
        </section>

        <section class="quick-view">

            <div class="main-infos">
                <h1><?php echo $announce['title'] ?></h1>

                <div class="rating"><?php echo generate_star($announce['rating']) ?></div>
                <div class="price"><?php echo $announce['price'] ?>€</div>
            </div>
            <hr>

            <div class="description">
                <p><?php echo $announce['description'] ?></p>
            </div>

            <hr>

            <div class="actions">
                <div class="manage-quantity">
                    <button class="increment" onclick="decrement()">-</button>
                    <span id="count">0</span>
                    <button class="decrement" onclick="increment()">+</button>
                </div>

                <button class="cart"><i class="fa fa-shopping-cart"></i></button>
                <button class="wish"><i class="fa fa-heart"></i></button>
            </div>
        </section>
    </div>

    <script src="../../scripts/announce.js"></script>
</body>

</html>