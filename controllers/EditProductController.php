<?php
session_start();
require_once '../config/database.php';
require_once '../models/Product.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = (float) $_POST['price'];
    $image = $_FILES['image']['name'];
    $category_id = (int) $_POST['category_id'];

    $database = new Database();
    $db = $database->getConnection();

    $product = new Product($db);
    $product->id = $id;
    $product->name = $name;
    $product->description = $description;
    $product->price = $price;
    $product->category_id = $category_id;

    // بررسی آپلود تصویر جدید
    if ($image) {
        // بررسی دایرکتوری uploads
        $target_dir = "../uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // آپلود تصویر
        $target_file = $target_dir . basename($image);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $product->image = $target_file;
        } else {
            echo "خطا در آپلود فایل. لطفاً دوباره تلاش کنید.";
            exit;
        }
    } else {
        // عدم تغییر تصویر
        $product->read_single();
        $product->image = $product->image;
    }

    if ($product->update()) {
        header("Location: ../views/edit_products.php");
        exit;
    } else {
        echo "خطا در ویرایش محصول. لطفاً دوباره تلاش کنید.";
    }
}
?>
