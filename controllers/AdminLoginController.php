<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->email = $email;
    $user->password = $password; // بررسی رمز عبور به صورت متن ساده

    error_log("Form submitted with email: $email"); // دیباگ برای فرم
    error_log("Password entered: $password");

    if ($user->authenticateAdmin()) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['is_admin'] = $user->is_admin;
        error_log("User logged in successfully: " . $user->email); // لاگ برای دیباگ
        header("Location: ../views/admin_panel.php");
        exit;
    } else {
        error_log("Login failed: Email or password incorrect, or not an admin."); // لاگ برای دیباگ
        header("Location: ../views/admin_login.php?error=true");
        exit;
    }
}
?>
