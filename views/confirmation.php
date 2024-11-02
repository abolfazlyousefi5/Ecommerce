<?php
require_once '../config/database.php';
require_once '../config/jalali.php'; // افزودن کتابخانه

$order_id = htmlspecialchars($_GET['order_id']);
$database = new Database();
$db = $database->getConnection();
$query = "SELECT created_at FROM orders WHERE id = :order_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':order_id', $order_id);
$stmt->execute();
$order = $stmt->fetch(PDO::FETCH_ASSOC);

$jdate = new jDateTime(true, true, 'Asia/Tehran'); // استفاده از کلاس jDateTime
$shamsi_date_time = $jdate->date("H:i:s d-m-Y", strtotime($order['created_at']));
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>تأیید خرید</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/confirmation.css">
</head>
<body>
    <header>
        <h1>خرید شما با موفقیت نهایی شد!</h1>
    </header>
    <div class="confirmation-container">
        <div class="confirmation-message">
            <h2>خرید شما با موفقیت انجام شد!</h2>
            <p>از خرید شما متشکریم. شماره سفارش شما: <strong><?php echo $order_id; ?></strong></p>
            <p>تاریخ سفارش: <?php echo $shamsi_date_time; ?></p> <!-- نمایش تاریخ و زمان شمسی -->
            <a href="../controllers/product_controller.php" class="btn">بازگشت به لیست محصولات</a>
        </div>
    </div>
    <footer>
        <p>© 2024 فروشگاه الکترونیکی ما. تمامی حقوق محفوظ است.</p>
    </footer>
</body>
</html>
