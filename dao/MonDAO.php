class MonDAO {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT m.*, c.ten_danh_muc 
                  FROM mon m 
                  LEFT JOIN categories c ON m.category_id = c.id 
                  ORDER BY m.ten_mon";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCategory($category_id) {
        $query = "SELECT * FROM mon WHERE category_id = :category_id 
                  AND trang_thai = 'con_hang' ORDER BY ten_mon";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT m.*, c.ten_danh_muc 
                  FROM mon m 
                  LEFT JOIN categories c ON m.category_id = c.id 
                  WHERE m.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO mon (ten_mon, gia, category_id, mo_ta, hinh_anh, trang_thai) 
                  VALUES (:ten_mon, :gia, :category_id, :mo_ta, :hinh_anh, :trang_thai)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ten_mon", $data['ten_mon']);
        $stmt->bindParam(":gia", $data['gia']);
        $stmt->bindParam(":category_id", $data['category_id']);
        $stmt->bindParam(":mo_ta", $data['mo_ta']);
        $stmt->bindParam(":hinh_anh", $data['hinh_anh']);
        $stmt->bindParam(":trang_thai", $data['trang_thai']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE mon SET ten_mon = :ten_mon, gia = :gia, 
                  category_id = :category_id, mo_ta = :mo_ta, 
                  hinh_anh = :hinh_anh, trang_thai = :trang_thai 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":ten_mon", $data['ten_mon']);
        $stmt->bindParam(":gia", $data['gia']);
        $stmt->bindParam(":category_id", $data['category_id']);
        $stmt->bindParam(":mo_ta", $data['mo_ta']);
        $stmt->bindParam(":hinh_anh", $data['hinh_anh']);
        $stmt->bindParam(":trang_thai", $data['trang_thai']);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM mon WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}