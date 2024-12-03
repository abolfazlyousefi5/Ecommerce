<?php
session_start();
session_destroy();
header("Location: ../index.php"); // هدایت به صفحه ثبت‌نام بعد از خروج
exit();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>خروج</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
</head>
<body>
    <h1>شما با موفقیت خارج شدید.</h1>
    <a href="register.php" class="btn">ثبت‌نام مجدد</a>
</body>
</html>
