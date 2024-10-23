<?php
require_once '../config/database.php';
require_once '../models/Cart.php';

$database = new Database();
$db = $database->getConnection();
$cart = new Cart($db);

$action = isset($_GET['action']) ? $_GET['action'] : "";

if($action == 'add') {
    $product_id = isset($_GET['id']) ? $_GET['id'] : "";
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
    if($cart->add_to_cart($product_id, $quantity)) {
        header("Location: ../views/cart.php");
    } else {
        echo "خطا در افزودن به سبد خرید";
    }
}

if($action == 'delete') {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if($cart->delete_from_cart($id)) {
        header("Location: ../views/cart.php");
    } else {
        echo "خطا در حذف از سبد خرید";
    }
}
?>
