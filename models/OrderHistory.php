<?php
class OrderHistory
{
    private $conn;
    private $table_name = "orders";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get_orders()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
