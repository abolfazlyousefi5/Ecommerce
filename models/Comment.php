<?php
require_once '../config/jalali.php'; // اضافه کردن کتابخانه

class Comment {
    private $conn;
    private $table_name = "comments";

    public $id;
    public $text;
    public $created_at;
    public $product_id;
    public $user_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (text, product_id, user_id, created_at) VALUES (:text, :product_id, :user_id, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":text", $this->text);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":user_id", $this->user_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read_all_for_product() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE product_id = :product_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // تبدیل تاریخ به شمسی
        $jdate = new jDateTime(true, true, 'Asia/Tehran');
        foreach ($comments as &$comment) {
            $comment['created_at'] = $jdate->date("Y-m-d H:i:s", strtotime($comment['created_at']));
        }
        return $comments;
    }
}
?>
