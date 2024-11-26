<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // تبدیل تاریخ و زمان به شمسی
    $jdate = new jDateTime(true, true, 'Asia/Tehran');
    $register_datetime = $jdate->date("Y-m-d H:i:s", time());

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->username = $username;
    $user->email = $email;
    $user->password = $password; // ذخیره رمز عبور به صورت متن ساده
    $user->is_admin = 1; // تعیین کاربر به عنوان ادمین
    $user->created_at = $register_datetime;

    if ($user->emailExists()) {
        $error_message = "این ایمیل قبلاً ثبت شده است.";
    } else {
        if ($user->create()) {
            $_SESSION['user_id'] = $db->lastInsertId();
            $_SESSION['is_admin'] = 1;
            header("Location: ../views/admin_login.php");
            exit;
        } else {
            $error_message = "خطا در ثبت‌نام. لطفاً دوباره تلاش کنید.";
        }
    }
}
?>
