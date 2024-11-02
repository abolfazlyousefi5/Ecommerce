<?php
session_start();
require_once '../config/database.php';
require_once '../models/Comment.php';

$database = new Database();
$db = $database->getConnection();

$comment = new Comment($db);
$comment->text = $_POST['comment'];
$comment->product_id = $_POST['product_id'];
$comment->user_id = $_SESSION['user_id']; // تنظیم user_id

if ($comment->create()) {
    header("Location: ../views/product_details.php?id=" . $comment->product_id);
    exit();
} else {
    echo "خطایی در افزودن نظر رخ داد.";
}
?>
