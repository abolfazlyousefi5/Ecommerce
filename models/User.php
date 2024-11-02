<?php
require_once '../config/jalali.php'; // اضافه کردن کتابخانه

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $password;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $jdate = new jDateTime(true, true, 'Asia/Tehran'); // استفاده از کلاس jDateTime
        $shamsi_date_time = $jdate->date("Y-m-d H:i:s", time());

        $query = "INSERT INTO " . $this->table_name . " (username, email, password, created_at) VALUES (:username, :email, :password, :created_at)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);

        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":created_at", $shamsi_date_time);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read_single() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->username = $row['username'];
        $this->email = $row['email'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET username = :username, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
