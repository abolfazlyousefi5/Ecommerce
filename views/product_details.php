<?php
require_once '../config/database.php';
require_once '../models/Product.php';
require_once '../models/Comment.php';

if (!isset($_GET['id'])) {
    echo "محصول یافت نشد.";
    exit;
}

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$product->id = $_GET['id'];
$product->read_single();

$comment = new Comment($db);
$comment->product_id = $product->id;
$comments = $comment->read_all_for_product();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>جزئیات محصول</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/product_details.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/comments.css">
</head>
<body>
    <header>
        <h1>جزئیات محصول</h1>
    </header>
    <div class="product-details">
        <h2><?php echo htmlspecialchars($product->name); ?></h2>
        <p><?php echo htmlspecialchars($product->description); ?></p>
        <p>قیمت: <?php echo htmlspecialchars($product->price); ?> تومان</p>
        <img src="../assets/images/<?php echo htmlspecialchars($product->image); ?>" alt="<?php echo htmlspecialchars($product->name); ?>">
        <a href="../controllers/product_controller.php" class="btn">بازگشت به لیست محصولات</a>

        <div class="comments-section">
            <h3>نظرات</h3>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <p><?php echo htmlspecialchars($comment['text']); ?></p>
                        <small><?php echo htmlspecialchars($comment['created_at']); ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>هیچ نظری موجود نیست.</p>
            <?php endif; ?>
        </div>

        <h3>افزودن نظر جدید</h3>
        <form action="../controllers/add_comment_controller.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product->id); ?>">
            <label for="comment">نظر:</label>
            <textarea id="comment" name="comment" rows="4" required></textarea>
            <button type="submit" class="btn">ارسال نظر</button>
        </form>
    </div>
    <footer>
        <p>© 2024 فروشگاه الکترونیکی ما. تمامی حقوق محفوظ است.</p>
    </footer>
</body>
</html>
