<?php
session_start();
require_once '../config/database.php';
require_once '../models/Product.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $database = new Database();
    $db = $database->getConnection();

    $product = new Product($db);
    $product->id = $id;

    if ($product->delete()) {
        header("Location: ../views/edit_product.php");
        exit;
    } else {
        echo "خطا در حذف محصول. لطفاً دوباره تلاش کنید.";
    }
}
?>
