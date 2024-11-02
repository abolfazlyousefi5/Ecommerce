<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$user->id = $_SESSION['user_id'];
$user->read_single();

?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ویرایش پروفایل</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/form.css">
</head>
<body>
    <h1>ویرایش پروفایل</h1>
    <form action="../controllers/edit_profile_controller.php" method="post">
        <label for="username">نام کاربری:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user->username); ?>" required>
        
        <label for="email">ایمیل:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user->email); ?>" required>
        
        <button type="submit" class="btn">ذخیره تغییرات</button>
    </form>
</body>
</html>
