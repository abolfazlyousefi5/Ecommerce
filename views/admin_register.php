<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ثبت‌نام ادمین</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/form.css">
</head>
<body>
    <h1>ثبت‌نام ادمین</h1>
    <form action="../controllers/AdminRegisterController.php" method="post">
        <label for="username">نام کاربری:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">ایمیل:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">رمز عبور:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit" class="btn">ثبت‌نام</button>
    </form>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
</body>
</html>
