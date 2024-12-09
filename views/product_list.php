<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فروشگاه</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/product_list.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
</head>
<body>
    <h1>لیست محصولات</h1>
    <form class="search-form" action="../controllers/search_controller.php" method="get">
        <label for="search">جستجوی محصولات:</label>
        <input type="text" id="search" name="search" placeholder="نام محصول را وارد کنید...">
        <button type="submit" class="btn">جستجو</button>
    </form>
    <div class="product-list">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p>قیمت: <?php echo htmlspecialchars($product['price']); ?> تومان</p>
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <a href="../views/product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn">مشاهده جزئیات</a> <!-- لینک به جزئیات محصول -->
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
