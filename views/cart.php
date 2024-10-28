<?php
require_once '../config/database.php';
require_once '../models/Cart.php';

$database = new Database();
$db = $database->getConnection();
$cart = new Cart($db);
$stmt = $cart->get_cart();

$items = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $items[] = $row;
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>سبد خرید</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/cart.css">
</head>
<body>
    <h1>سبد خرید</h1>
    <div class="cart-list">
        <?php if (!empty($items)): ?>
            <?php foreach ($items as $item): ?>
                <div class="cart-item">
                    <h2><?php echo htmlspecialchars($item['name']); ?></h2>
                    <p>قیمت: <?php echo htmlspecialchars($item['price']); ?> تومان</p>
                    <p>تعداد: <?php echo htmlspecialchars($item['quantity']); ?></p>
                    <a href="../controllers/cart_controller.php?action=delete&id=<?php echo htmlspecialchars($item['id']); ?>" class="btn">حذف</a>
                </div>
            <?php endforeach; ?>
            <div class="finalize-btn-container">
                <form action="../controllers/order_controller.php" method="post">
                    <button type="submit" class="btn">نهایی کردن خرید</button>
                </form>
            </div>
        <?php else: ?>
            <p>سبد خرید خالی است.</p>
        <?php endif; ?>

    <a href="../controllers/product_controller.php" class="return-btn">بازگشت به لیست محصولات</a>
</body>
</html>
