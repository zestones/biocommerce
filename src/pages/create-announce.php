<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovia - Home</title>

    <script src="../../scripts/theme.js"></script>

    <link rel="stylesheet" href="../../styles/create-announce.css" onload="load_theme()">
    <link rel="stylesheet" href="../../styles/main-header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
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

    <section class="submit-announce-section">
        <h2>Submit a New Announcement</h2>
        <form id="submit-announce-form" enctype="multipart/form-data" action="../php/submit-announce.php" method="POST">

            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category">
                    <?php
                    require "../php/category.php";
                    $categories = get_all_categories();
                    foreach ($categories as $category) {
                        echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="4" required></textarea>
            </div>

            <div class="integer-forms">
                <div class="form-group integer-group">
                    <label for="price">Price:</label>
                    <input type="number" name="price" id="price" step="0.01" required>
                </div>

                <div class="form-group integer-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" required>
                </div>
            </div>

            <div class="image-section">
                <div class="drop-zone">
                    <span class="drop-zone-prompt">Drop file here or click to upload</span>
                    <input type="file" name="pictures[]" class="drop-zone-input" accept="image/*">
                </div>

                <div class="drop-zone">
                    <span class="drop-zone-prompt">Drop file here or click to upload</span>
                    <input type="file" name="pictures[]" class="drop-zone-input" accept="image/*">
                </div>

                <div class="drop-zone">
                    <span class="drop-zone-prompt">Drop file here or click to upload</span>
                    <input type="file" name="pictures[]" class="drop-zone-input" accept="image/*">
                </div>

                <div class="drop-zone">
                    <span class="drop-zone-prompt">Drop file here or click to upload</span>
                    <input type="file" name="pictures[]" class="drop-zone-input" accept="image/*">
                </div>
            </div>

            <button class="submit-btn" type="submit">Submit</button>
        </form>
    </section>

    <script src="../scripts/create-announce.js"></script>
</body>

</html>