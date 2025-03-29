<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // دریافت ایمیل و رمز عبور از ورودی فرم
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // کوئری برای پیدا کردن کاربر بر اساس ایمیل
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $db->prepare($query);

    // مقداردهی به پارامتر کوئری
    $stmt->bindParam(':email', $email);

    // اجرای کوئری
    $stmt->execute();

    // دریافت اطلاعات کاربر
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // بررسی مطابقت ایمیل و رمز عبور
    if ($user && $password === $user['password']) {
        // ذخیره اطلاعات کاربر در سشن
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../controllers/product_controller.php");
        exit();
    } else {
        // پیام خطا
        echo "ایمیل یا رمز عبور اشتباه است.";
    }
}
?>
