<?php
require_once '../config/database.php';
require_once '../models/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user->username = $_POST['username'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    if ($user->create()) {
        echo "ثبت‌نام با موفقیت انجام شد.";
    } else {
        echo "خطایی در ثبت‌نام رخ داد.";
    }
}
