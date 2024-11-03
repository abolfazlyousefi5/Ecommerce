<?php
class Wishlist {
    private $conn;
    private $table_name = "wishlist";

    public $id;
    public $user_id;
    public $product_id;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function add() {
        $query = "INSERT INTO " . $this->table_name . " (user_id, product_id, created_at) VALUES (:user_id, :product_id, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":product_id", $this->product_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read_all_for_user() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function remove() {
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":product_id", $this->product_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function isInWishlist() {
        $query = "SELECT COUNT(*) as count FROM " . $this->table_name . " WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'] > 0;
    }
}
?>
