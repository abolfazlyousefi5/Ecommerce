<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$user->id = $_SESSION['user_id'];
$user->username = $_POST['username'];
$user->email = $_POST['email'];

if ($user->update()) {
    echo "پروفایل شما با موفقیت به‌روزرسانی شد.";
} else {
    echo "خطایی در به‌روزرسانی پروفایل رخ داد.";
}
?>
