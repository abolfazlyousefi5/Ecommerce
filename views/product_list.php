<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فروشگاه</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
    <h1>لیست محصولات</h1>
    <div class="product-list">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p>قیمت: <?php echo htmlspecialchars($product['price']); ?> تومان</p>
                    <img src="../assets/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <form action="../controllers/cart_controller.php" method="get" class="product-form">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                        <label for="quantity">تعداد:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1">
                        <button type="submit" class="btn">افزودن به سبد خرید</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>هیچ محصولی یافت نشد.</p>
        <?php endif; ?>
    </div>
</body>
</html>
