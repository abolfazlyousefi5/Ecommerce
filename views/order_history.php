<?php
require_once '../config/database.php';
require_once '../models/Order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);

$query = "SELECT * FROM orders ORDER BY created_at DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>تاریخچه سفارشات</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/order_history.css">
</head>
<body>
    <h1>تاریخچه سفارشات</h1>
    <div class="order-history">
        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-item">
                    <p>شماره سفارش: <?php echo htmlspecialchars($order['id']); ?></p>
                    <p>مبلغ کل: <?php echo htmlspecialchars($order['total_price']); ?> تومان</p>
                    <p>تاریخ سفارش: <?php echo htmlspecialchars($order['created_at']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>هیچ سفارشی یافت نشد.</p>
        <?php endif; ?>
    </div>
    <a href="../controllers/product_controller.php" class="return-btn">بازگشت به لیست محصولات</a>
</body>
</html>
