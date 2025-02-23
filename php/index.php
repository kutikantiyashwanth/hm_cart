<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HM CART</title>
    <link rel="icon" href="img/core-img/logo2.png">
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main-content-wrapper d-flex clearfix">
    <div class="mobile-nav">
        <!-- ... Keep mobile nav ... -->
    </div>

    <header class="header-area clearfix">
        <div class="cart-fav-search mb-100">
            <a href="cart.php" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Cart <span id="cart-count">(<?php echo count($_SESSION['cart']); ?>)</span></a>
        </div>
    </header>

    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">
            <?php
            $products = [
                ['id' => 1, 'name' => 'Bottle sets', 'price' => 180, 'img' => 'img/bg-img/b.jpg'],
                ['id' => 2, 'name' => 'Crochet bag', 'price' => 180, 'img' => 'img/bg-img/b2.jpg'],
                ['id' => 3, 'name' => 'Jute baskets', 'price' => 150, 'img' => 'img/bg-img/b3.jpg'],
                ['id' => 4, 'name' => 'Mortar & Pestle', 'price' => 180, 'img' => 'img/bg-img/b4.jpg'],
                ['id' => 5, 'name' => 'Measuring cup set', 'price' => 208, 'img' => 'img/bg-img/a3.jpg'],
                ['id' => 6, 'name' => 'Iconic rope chairs', 'price' => 520, 'img' => 'img/bg-img/b7.jpg'],
                ['id' => 7, 'name' => 'Ceramic Bottle', 'price' => 318, 'img' => 'img/bg-img/45.jpg'],
                ['id' => 8, 'name' => 'Kitchen', 'price' => 318, 'img' => 'img/bg-img/k13.avif'],
                ['id' => 9, 'name' => 'H', 'price' => 318, 'img' => 'img/bg-img/9.jpg']
            ];

            foreach ($products as $product) {
                echo '
                <div class="single-products-catagory clearfix">
                    <a href="product-details.php?id=' . $product['id'] . '">
                        <img src="' . $product['img'] . '" alt="">
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From $' . $product['price'] . '</p>
                            <h4>' . $product['name'] . '</h4>
                        </div>
                    </a>
                    <button class="btn amado-btn mt-2 add-to-cart" 
                        data-id="' . $product['id'] . '" 
                        data-name="' . $product['name'] . '" 
                        data-price="' . $product['price'] . '" 
                        data-img="' . $product['img'] . '">Add to Cart</button>
                </div>';
            }
            ?>
        </div>
    </div>
</div>

<script src="js/jquery/jquery-2.2.4.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
</body>
</html>