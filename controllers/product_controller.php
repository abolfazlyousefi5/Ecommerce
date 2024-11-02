<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/register.php");
    exit;
}

require_once '../config/database.php';
require_once '../models/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$stmt = $product->read();

$products = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $products[] = $row;
}
include '../views/product_list.php';
?>
