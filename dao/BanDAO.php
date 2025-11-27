class BanDAO {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM ban ORDER BY ten_ban";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM ban WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO ban (ten_ban, so_cho, trang_thai, khu_vuc) 
                  VALUES (:ten_ban, :so_cho, :trang_thai, :khu_vuc)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ten_ban", $data['ten_ban']);
        $stmt->bindParam(":so_cho", $data['so_cho']);
        $stmt->bindParam(":trang_thai", $data['trang_thai']);
        $stmt->bindParam(":khu_vuc", $data['khu_vuc']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE ban SET ten_ban = :ten_ban, so_cho = :so_cho, 
                  trang_thai = :trang_thai, khu_vuc = :khu_vuc WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":ten_ban", $data['ten_ban']);
        $stmt->bindParam(":so_cho", $data['so_cho']);
        $stmt->bindParam(":trang_thai", $data['trang_thai']);
        $stmt->bindParam(":khu_vuc", $data['khu_vuc']);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM ban WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function getBanTrong() {
        $query = "SELECT * FROM ban WHERE trang_thai = 'trong' ORDER BY ten_ban";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
