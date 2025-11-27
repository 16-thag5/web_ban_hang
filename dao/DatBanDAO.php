class DatBanDAO {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT db.*, b.ten_ban 
                  FROM dat_ban db 
                  LEFT JOIN ban b ON db.ban_id = b.id 
                  ORDER BY db.thoi_gian DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO dat_ban (ban_id, ten_khach, sdt, thoi_gian, so_nguoi, ghi_chu, trang_thai) 
                  VALUES (:ban_id, :ten_khach, :sdt, :thoi_gian, :so_nguoi, :ghi_chu, :trang_thai)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ban_id", $data['ban_id']);
        $stmt->bindParam(":ten_khach", $data['ten_khach']);
        $stmt->bindParam(":sdt", $data['sdt']);
        $stmt->bindParam(":thoi_gian", $data['thoi_gian']);
        $stmt->bindParam(":so_nguoi", $data['so_nguoi']);
        $stmt->bindParam(":ghi_chu", $data['ghi_chu']);
        $stmt->bindParam(":trang_thai", $data['trang_thai']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE dat_ban SET trang_thai = :trang_thai WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":trang_thai", $data['trang_thai']);
        return $stmt->execute();
    }
}
