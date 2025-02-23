<?php
session_start();
if (!isset($_SESSION['last_order'])) {
    header("Location: index.php");
    exit();
}
$order = $_SESSION['last_order'];
unset($_SESSION['last_order']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Successful - HM CART</title>
    <link rel="icon" href="img/core-img/logo2.png">
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .success-container {
            text-align: center;
            padding: 100px 0;
        }
        .success-logo {
            max-width: 200px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <img src="img/core-img/success.png" alt="Order Success" class="success-logo">
        <h1>Order Placed Successfully!</h1>
        <p>Thank you for your purchase. Your order total was $<?php echo $order['total']; ?>.00</p>
        <a href="index.php" class="btn amado-btn mt-3">Continue Shopping</a>
    </div>

    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/active.js"></script>
</body>
</html>