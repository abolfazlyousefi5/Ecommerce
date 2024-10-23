<?php
require_once '../config/database.php';
require_once '../models/Cart.php';

$database = new Database();
$db = $database->getConnection();
$cart = new Cart($db);

if ($cart->clear_cart()) {
    echo "خرید شما با موفقیت نهایی شد. از خرید شما متشکریم!";
} else {
    echo "خطا در نهایی کردن خرید";
}
?>
