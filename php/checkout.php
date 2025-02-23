<?php
session_start();
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $total = array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $_SESSION['cart']));
    unset($_SESSION['cart']); // Clear cart after order
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - HM CART</title>
    <link rel="icon" href="img/core-img/logo2.png">
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">
    <style>
        #successPopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            text-align: center;
            z-index: 1000;
        }
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
    </style>
</head>
<body>
    <header class="header-area clearfix">
        <!-- ... Keep existing header ... -->
        <div class="cart-fav-search mb-100">
            <a href="cart.php" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Cart <span id="cart-count">(<?php echo count($_SESSION['cart']); ?>)</span></a>
            <!-- ... Keep rest ... -->
        </div>
    </header>

    <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="checkout_details_area mt-50 clearfix">
                        <div class="cart-title">
                            <h2>Checkout</h2>
                        </div>
                        <form id="checkoutForm" action="checkout.php" method="post">
                            <!-- Existing form fields -->
                            <div class="row">
                                <!-- ... Keep existing form fields ... -->
                                <div class="col-12 mt-3">
                                    <button type="submit" name="place_order" class="btn amado-btn w-100">Place Order</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>Cart Total</h5>
                        <ul class="summary-table">
                            <li><span>subtotal:</span> <span>$<?php echo $subtotal = array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $_SESSION['cart'])); ?>.00</span></li>
                            <li><span>delivery:</span> <span>Free</span></li>
                            <li><span>total:</span> <span>$<?php echo $subtotal; ?>.00</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="overlay"></div>
    <div id="successPopup">
        <i class="fa fa-check-circle" style="font-size: 50px; color: green;"></i>
        <h2>Order Placed Successfully!</h2>
        <p>Your order total was $<?php echo $subtotal; ?>.00</p>
        <button onclick="closePopup()" class="btn amado-btn">Continue Shopping</button>
    </div>

    <!-- Existing footer content -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/active.js"></script>
    <script>
        $(document).ready(function() {
            $('#checkoutForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'checkout.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function() {
                        $('#overlay').show();
                        $('#successPopup').show();
                        $('#cart-count').text('(0)');
                    }
                });
            });
        });

        function closePopup() {
            $('#overlay').hide();
            $('#successPopup').hide();
            window.location.href = 'index.php';
        }
    </script>
</body>
</html>