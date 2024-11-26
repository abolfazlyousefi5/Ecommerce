<?php
session_start();
// اگر کاربر مدیر نیست، او را به صفحه لاگین ادمین هدایت کن
if (!isset($_SESSION['is_admin']) & $_SESSION['is_admin'] !== true) {
    header('Location: admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریتی</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/admin_panel.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>پنل مدیریتی</h1>
            <nav>
                <ul>
                    <li><a href="add_product.php">افزودن محصول</a></li>
                    <li><a href="edit_products.php">ویرایش محصولات</a></li>
                    <li><a href="order_management.php">مدیریت سفارشات</a></li>
                    <li><a href="logout.php">خروج</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="content">
            <h2>خوش آمدید، ادمین عزیز!</h2>
            <p>از اینجا می‌تونید محصولات جدید اضافه کنید، محصولات فعلی رو ویرایش کنید و سفارشات رو مدیریت کنید.</p>
        </div>
    </main>
    <footer>
        <p>© 2024 پنل مدیریتی فروشگاه. تمامی حقوق محفوظ است.</p>
    </footer>
</body>
</html>
