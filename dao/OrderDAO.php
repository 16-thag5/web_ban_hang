class OrderDAO {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT o.*, b.ten_ban, u.ho_ten 
                  FROM orders o 
                  LEFT JOIN ban b ON o.ban_id = b.id 
                  LEFT JOIN users u ON o.user_id = u.id 
                  ORDER BY o.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT o.*, b.ten_ban, u.ho_ten 
                  FROM orders o 
                  LEFT JOIN ban b ON o.ban_id = b.id 
                  LEFT JOIN users u ON o.user_id = u.id 
                  WHERE o.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO orders (ban_id, user_id, tong_tien, trang_thai) 
                  VALUES (:ban_id, :user_id, :tong_tien, :trang_thai)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ban_id", $data['ban_id']);
        $stmt->bindParam(":user_id", $data['user_id']);
        $stmt->bindParam(":tong_tien", $data['tong_tien']);
        $stmt->bindParam(":trang_thai", $data['trang_thai']);
        
        if($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function update($id, $data) {
        $query = "UPDATE orders SET tong_tien = :tong_tien, 
                  trang_thai = :trang_thai WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":tong_tien", $data['tong_tien']);
        $stmt->bindParam(":trang_thai", $data['trang_thai']);
        return $stmt->execute();
    }

    public function getOrdersByBan($ban_id) {
        $query = "SELECT * FROM orders WHERE ban_id = :ban_id 
                  AND trang_thai IN ('cho_xu_ly', 'dang_phuc_vu') 
                  ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ban_id", $ban_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}