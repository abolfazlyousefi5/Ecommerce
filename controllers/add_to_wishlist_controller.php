<?php
session_start();
require_once '../config/database.php';
require_once '../models/Wishlist.php';

$database = new Database();
$db = $database->getConnection();
$wishlist = new Wishlist($db);
$wishlist->user_id = $_SESSION['user_id'];
$wishlist->product_id = $_POST['product_id'];

if ($wishlist->add()) {
    header("Location: ../views/product_details.php?id=" . $wishlist->product_id);
    exit();
} else {
    echo "خطایی در افزودن به لیست علاقه‌مندی‌ها رخ داد.";
}
?>
