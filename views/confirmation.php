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
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
</head>
<body>
    <h1>خرید شما با موفقیت نهایی شد!</h1>
    <p>شماره سفارش شما: <?php echo $order_id; ?></p>
    <p>تاریخ سفارش: <?php echo $shamsi_date_time; ?></p> <!-- نمایش تاریخ و زمان شمسی -->
    <a href="../controllers/product_controller.php" class="return-btn">بازگشت به لیست محصولات</a>
</body>
</html>
