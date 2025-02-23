<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add to cart via AJAX
if (isset($_POST['add_to_cart'])) {
    $product = [
        'id' => $_POST['product_id'],
        'name' => $_POST['product_name'],
        'price' => $_POST['product_price'],
        'img' => $_POST['product_img'],
        'quantity' => 1
    ];

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product['id']) {
            $item['quantity']++;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = $product;
    }
    echo json_encode(['success' => true]);
    exit();
}

// Update quantity
if (isset($_POST['update_qty'])) {
    $productId = $_POST['product_id'];
    $change = $_POST['change'];
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            $item['quantity'] += $change;
            if ($item['quantity'] <= 0) {
                unset($_SESSION['cart'][array_search($item, $_SESSION['cart'])]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
            break;
        }
    }
    echo json_encode(['success' => true]);
    exit();
}
?>

<div class="cart-fav-search mb-100">
    <a href="cart.php" class="cart-nav">
        <img src="img/core-img/a1.jpg" alt=""> Cart <span>(<?php echo count($_SESSION['cart']); ?>)</span>
    </a>
    <a href="#" class="fav-nav">
        <img src="img/core-img/favorites.png" alt=""> Favourite
    </a>
    <a href="#" class="search-nav">
        <img src="img/core-img/search.png" alt=""> Search
    </a>
</div>
