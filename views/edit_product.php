<?php
session_start();
require_once '../config/database.php';
require_once '../models/Product.php';
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$stmt = $product->read();
$editProduct = null;
if (isset($_GET['id'])) {
    $editProduct = new Product($db);
    $editProduct->id = $_GET['id'];
    $editProduct->read_single();
} ?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>ویرایش محصولات</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/add_product.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/list_products.css">
    <script>
        function showFileName(event) {
            var input = event.target;
            var fileName = input.files[0].name;
            var fileNameDisplay = document.getElementById('file-name');
            fileNameDisplay.textContent = 'فایل انتخاب شده: ' + fileName;
        }
    </script>
</head>

<body>
    <header>
        <div class="container">
            <h1>ویرایش محصولات</h1>
            <nav>
                <ul>
                    <li><a href="admin_panel.php">صفحه اصلی پنل</a></li>
                    <li><a href="add_product.php">افزودن محصول</a></li>
                    <li><a href="order_management.php">مدیریت سفارشات</a></li>
                    <li><a href="logout.php">خروج</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="content">
            <h2>محصولات موجود</h2>
            <table>
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام</th>
                        <th>توضیحات</th>
                        <th>قیمت</th>
                        <th>تصویر</th>
                        <th>دسته‌بندی</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody> <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?> <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" width="50"></td>
                            <td><?php echo htmlspecialchars($row['category_id']); ?></td>
                            <td> <a href="edit_product.php?id=<?php echo $row['id']; ?>">ویرایش</a> </td>
                        </tr> <?php endwhile; ?> </tbody>
            </table>
        </div> <?php if ($editProduct): ?> <div class="content">
                <h2>ویرایش محصول</h2>
                <form action="../controllers/EditProductController.php" method="post" enctype="multipart/form-data"> <input type="hidden" name="id" value="<?php echo htmlspecialchars($editProduct->id, ENT_QUOTES, 'UTF-8'); ?>"> <label for="name">نام محصول:</label> <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($editProduct->name, ENT_QUOTES, 'UTF-8'); ?>" required> <label for="description">توضیحات محصول:</label> <textarea id="description" name="description" required><?php echo htmlspecialchars($editProduct->description, ENT_QUOTES, 'UTF-8'); ?></textarea> <label for="price">قیمت:</label> <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($editProduct->price, ENT_QUOTES, 'UTF-8'); ?>" required> <label for="image">تصویر:</label> <label id="file-label" class="custom-file-upload"> <input type="file" id="image" name="image" accept="image/*" onchange="showFileName(event)"> انتخاب فایل </label> <span id="file-name" class="file-name"><?php echo htmlspecialchars($editProduct->image, ENT_QUOTES, 'UTF-8'); ?></span> <label for="category_id">دسته‌بندی:</label> <select id="category_id" name="category_id" required>
                        <option value="1" <?php echo ($editProduct->category_id == 1) ? 'selected' : ''; ?>>موبایل</option>
                        <option value="2" <?php echo ($editProduct->category_id == 2) ? 'selected' : ''; ?>>لپ تاپ</option>
                        <option value="3" <?php echo ($editProduct->category_id == 3) ? 'selected' : ''; ?>>هدفون</option>
                        <option value="4" <?php echo ($editProduct->category_id == 4) ? 'selected' : ''; ?>>تلوزیون</option>
                    </select> <button type="submit">ویرایش محصول</button> </form>
            </div> <?php endif; ?>
    </main>
    <footer>
        <p>© 2024 پنل مدیریتی فروشگاه. تمامی حقوق محفوظ است.</p>
    </footer>
</body>

</html>