<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ثبت‌نام</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/register.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
</head>
<body>
    <h1>ثبت‌نام</h1>
    <form action="../controllers/register_controller.php" method="post">
        <label for="username">نام کاربری:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="email">ایمیل:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">رمز عبور:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit" class="btn">ثبت‌نام</button>
    </form>
</body>
</html>
