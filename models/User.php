<?php
require_once '../config/jalali.php'; // اضافه کردن کتابخانه

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $password;
    public $is_admin;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function emailExists() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function create() {
        $jdate = new jDateTime(true, true, 'Asia/Tehran'); // استفاده از کلاس jDateTime
        $shamsi_date_time = $jdate->date("Y-m-d H:i:s", time());

        $query = "INSERT INTO " . $this->table_name . " (username, email, password, is_admin, created_at) VALUES (:username, :email, :password, :is_admin, :created_at)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);

        $stmt->bindParam(":password", $this->password); // ذخیره رمز عبور به صورت متن ساده
        $stmt->bindParam(":is_admin", $this->is_admin); // اضافه کردن is_admin
        $stmt->bindParam(":created_at", $shamsi_date_time);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function authenticateAdmin() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            error_log("User found: " . print_r($user, true)); // دیباگ برای یافتن کاربر
        }

        if ($user && $this->password == $user['password'] && $user['is_admin']) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->is_admin = $user['is_admin'];
            return true;
        }
        return false;
    }

    public function authenticate() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            error_log("User found: " . print_r($user, true)); // دیباگ برای یافتن کاربر
        }

        if ($user && $this->password == $user['password']) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            return true;
        }
        return false;
    }
}
?>
