<?php
session_start();
require_once '../config/database.php';
require_once '../models/Product.php';
require_once '../models/Comment.php';
require_once '../models/Rating.php';
require_once '../models/Wishlist.php';

if (!isset($_GET['id'])) {
    echo "محصول یافت نشد.";
    exit;
}

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$product->id = $_GET['id'];
$product->read_single();
$similar_products = $product->getSimilarProducts();

$comment = new Comment($db);
$comment->product_id = $product->id;
$comments = $comment->read_all_for_product();

$rating = new Rating($db);
$rating->product_id = $product->id;
$average_rating = $rating->read_avg_for_product();
$average_rating = $average_rating ?: 0;

$wishlist = new Wishlist($db);
$wishlist->user_id = $_SESSION['user_id'];
$wishlist->product_id = $product->id;
$is_in_wishlist = $wishlist->isInWishlist();
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
    <link rel="stylesheet" type="text/css" href="../assets/css/ratings.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
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

        <?php if ($is_in_wishlist): ?>
            <form action="../controllers/remove_from_wishlist_controller.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product->id); ?>">
                <button type="submit" class="btn">حذف از لیست علاقه‌مندی‌ها</button>
            </form>
        <?php else: ?>
            <form action="../controllers/add_to_wishlist_controller.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product->id); ?>">
                <button type="submit" class="btn">افزودن به لیست علاقه‌مندی‌ها</button>
            </form>
        <?php endif; ?>

        <div class="average-rating">
            <h3>امتیاز میانگین: <?php echo round($average_rating, 1); ?></h3>
        </div>
        <form class="rating-form" action="../controllers/add_rating_controller.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product->id); ?>">
            <label for="rating">امتیاز شما:</label>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
            </div>
            <button type="submit" class="btn">ثبت امتیاز</button>
        </form>

        <div class="comments-section">
            <h3>نظرات</h3>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <p><?php echo htmlspecialchars($comment['text']); ?></p>
                        <small><?php echo htmlspecialchars($comment['created_at']); ?></small> <!-- تاریخ شمسی ذخیره شده -->
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>هیچ نظری موجود نیست.</p>
            <?php endif; ?>
        </div>

        <div class="add-comment-form">
            <h3>افزودن نظر جدید</h3>
            <form action="../controllers/add_comment_controller.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product->id); ?>">
                <label for="comment">نظر:</label>
                <textarea id="comment" name="comment" rows="4" required></textarea>
                <button type="submit" class="btn">ارسال نظر</button>
            </form>
        </div>
        
        <div class="similar-products">
            <h3>محصولات مشابه</h3>
            <?php if (!empty($similar_products)): ?>
                <div class="product-list">
                    <?php foreach ($similar_products as $similar_product): ?>
                        <div class="product">
                            <h4><?php echo htmlspecialchars($similar_product['name']); ?></h4>
                            <p><?php echo htmlspecialchars($similar_product['description']); ?></p>
                            <a href="product_details.php?id=<?php echo htmlspecialchars($similar_product['id']); ?>" class="btn">مشاهده محصول</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>هیچ محصول مشابهی یافت نشد.</p>
            <?php endif; ?>
        </div>

    </div>
    <footer>
        <p>© 2024 فروشگاه الکترونیکی ما. تمامی حقوق محفوظ است.</p>
    </footer>
</body>
</html>
