class OrderItemDAO {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = "INSERT INTO order_items (order_id, mon_id, so_luong, gia, ghi_chu) 
                  VALUES (:order_id, :mon_id, :so_luong, :gia, :ghi_chu)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":order_id", $data['order_id']);
        $stmt->bindParam(":mon_id", $data['mon_id']);
        $stmt->bindParam(":so_luong", $data['so_luong']);
        $stmt->bindParam(":gia", $data['gia']);
        $stmt->bindParam(":ghi_chu", $data['ghi_chu']);
        return $stmt->execute();
    }

    public function getByOrderId($order_id) {
        $query = "SELECT oi.*, m.ten_mon, m.hinh_anh 
                  FROM order_items oi 
                  LEFT JOIN mon m ON oi.mon_id = m.id 
                  WHERE oi.order_id = :order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}