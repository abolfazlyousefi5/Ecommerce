<?php
class Rating {
    private $conn;
    private $table_name = "ratings";

    public $id;
    public $rating;
    public $created_at;
    public $product_id;
    public $user_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (rating, product_id, user_id, created_at) VALUES (:rating, :product_id, :user_id, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":user_id", $this->user_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read_avg_for_product() {
        $query = "SELECT AVG(rating) as average_rating FROM " . $this->table_name . " WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['average_rating'];
    }
}
?>
