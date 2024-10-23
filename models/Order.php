<?php
require_once '../config/jalali.php';

class Order {
    private $conn;
    private $table_name = "orders";

    public $id;
    public $total_price;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($total_price) {
        $jdate = new jDateTime(true, true, 'Asia/Tehran');
        $shamsi_date_time = $jdate->date("H:i:s d-m-Y ", time());

        $query = "INSERT INTO " . $this->table_name . " (total_price, created_at) VALUES (:total_price, :created_at)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":total_price", $total_price);
        $stmt->bindParam(":created_at", $shamsi_date_time);

        if($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function empty_cart() {
        $query = "DELETE FROM cart";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
}
?>
