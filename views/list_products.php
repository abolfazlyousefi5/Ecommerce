<?php
session_start();
require_once '../config/database.php';
require_once '../models/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$stmt = $product->read();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>لیست محصولات</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/add_product.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/list_products.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>لیست محصولات</h1>
            <nav>
                <ul>
                    <li><a href="admin_panel.php">صفحه اصلی پنل</a></li>
                    <li><a href="add_product.php">افزودن محصول</a></li>
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
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" width="50"></td>
                        <td><?php echo htmlspecialchars($row['category_id']); ?></td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $row['id']; ?>">ویرایش</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <p>© 2024 پنل مدیریتی فروشگاه. تمامی حقوق محفوظ است.</p>
    </footer>
</body>
</html>
