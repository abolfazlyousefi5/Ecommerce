<?php
session_start();
require_once '../config/database.php';
require_once '../models/Rating.php';

$database = new Database();
$db = $database->getConnection();

$rating = new Rating($db);
$rating->rating = $_POST['rating'];
$rating->product_id = $_POST['product_id'];
$rating->user_id = $_SESSION['user_id']; // تنظیم user_id

if ($rating->create()) {
    header("Location: ../views/product_details.php?id=" . $rating->product_id);
    exit();
} else {
    echo "خطایی در افزودن امتیاز رخ داد.";
}
?>
