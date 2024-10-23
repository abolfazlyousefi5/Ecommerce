<?php
require_once '../config/database.php';
require_once '../models/OrderHistory.php';

$database = new Database();
$db = $database->getConnection();
$order_history = new OrderHistory($db);

$stmt = $order_history->get_orders();

$orders = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $orders[] = $row;
}

include '../views/order_history.php';
