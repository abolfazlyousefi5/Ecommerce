<?php
session_start();
// اگر کاربر مدیر نیست، او را به صفحه لاگین ادمین هدایت کن
if (!isset($_SESSION['is_admin']) && $_SESSION['is_admin'] !== true) {
    header('Location: admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>افزودن محصول</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/add_product.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <script>
        function showFileName(event) {
            var input = event.target;
            var label = document.getElementById('file-label');
            var fileName = input.files[0].name;
            var fileNameDisplay = document.getElementById('file-name');
            fileNameDisplay.textContent = 'فایل انتخاب شده: ' + fileName;
        }
    </script>
</head>
<body>
    <header>
        <div class="container">
            <h1>افزودن محصول</h1>
            <nav>
                <ul>
                    <li><a href="admin_panel.php">صفحه اصلی پنل</a></li>
                    <li><a href="edit_products.php">ویرایش محصولات</a></li>
                    <li><a href="order_management.php">مدیریت سفارشات</a></li>
                    <li><a href="logout.php">خروج</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="content">
            <h2>افزودن محصول جدید</h2>
            <form action="../controllers/AddProductController.php" method="post" enctype="multipart/form-data">
                <label for="name">نام محصول:</label>
                <input type="text" id="name" name="name" required>

                <label for="description">توضیحات محصول:</label>
                <textarea id="description" name="description" required></textarea>

                <label for="price">قیمت:</label>
                <input type="number" id="price" name="price" required>

                <label for="image">تصویر:</label>
                <label id="file-label" class="custom-file-upload">
                    <input type="file" id="image" name="image" accept="image/*" required onchange="showFileName(event)">
                    انتخاب فایل
                </label>
                <span id="file-name" class="file-name"></span>

                <label for="category_id">دسته‌بندی:</label>
                <select id="category_id" name="category_id" required>
                    <option value="1">موبایل</option>
                    <option value="2">لپ تاپ</option>
                    <option value="3">هدفون</option>
                    <option value="4">تلوزیون</option>
                </select>

                <button type="submit">افزودن محصول</button>
            </form>
        </div>
    </main>
    <footer>
        <p>© 2024 پنل مدیریتی فروشگاه. تمامی حقوق محفوظ است.</p>
    </footer>
</body>
</html>
