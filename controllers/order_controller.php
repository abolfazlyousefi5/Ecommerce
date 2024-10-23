<?php
require_once '../config/database.php';
require_once '../models/Cart.php';
require_once '../models/Order.php';

$database = new Database();
$db = $database->getConnection();
$cart = new Cart($db);
$order = new Order($db);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $total_price = 0;
    $stmt = $cart->get_cart();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $total_price += $row['price'] * $row['quantity'];
    }

    if($order_id = $order->create($total_price)) {
        $order->empty_cart();
        header("Location: ../views/confirmation.php?order_id=$order_id");
    } else {
        echo "خطا در نهایی کردن خرید";
    }
}
?>
