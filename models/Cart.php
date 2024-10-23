<?php
class Cart {
    private $conn;
    private $table_name = "cart";

    public $id;
    public $product_id;
    public $quantity;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function add_to_cart($product_id, $quantity) {
        $query = "INSERT INTO " . $this->table_name . " (product_id, quantity) VALUES (:product_id, :quantity)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":product_id", $product_id);
        $stmt->bindParam(":quantity", $quantity);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function get_cart() {
        $query = "SELECT c.id, p.name, p.price, c.quantity FROM " . $this->table_name . " c INNER JOIN products p ON c.product_id = p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function delete_from_cart($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function clear_cart() {
        $query = "DELETE FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
