<?php
session_start();
require_once '../config/database.php';
require_once '../models/Product.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $category_id = (int) $_POST['category_id'];

    // بررسی دایرکتوری uploads
    $target_dir = "../uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // آپلود تصویر
    $target_file = $target_dir . basename($image);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $database = new Database();
        $db = $database->getConnection();

        $product = new Product($db);
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->image = $target_file;
        $product->category_id = $category_id;
        $product->created_at = date(format: 'Y-m-d H:i:s');

        if ($product->create()) {
            header("Location: ../views/admin_panel.php");
            exit;
        } else {
            echo "خطا در افزودن محصول. لطفاً دوباره تلاش کنید.";
        }
    } else {
        echo "خطا در آپلود فایل. لطفاً دوباره تلاش کنید.";
    }
}
?>
