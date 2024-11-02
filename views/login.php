<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ورود</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/form.css">
</head>
<body>
    <h1>ورود</h1>
    <form action="../controllers/login_controller.php" method="post">
        <label for="email">ایمیل:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">رمز عبور:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit" class="btn">ورود</button>
    </form>
</body>
</html>
