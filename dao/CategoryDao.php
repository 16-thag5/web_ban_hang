class CategoryDAO {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM categories ORDER BY ten_danh_muc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO categories (ten_danh_muc, mo_ta) 
                  VALUES (:ten_danh_muc, :mo_ta)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ten_danh_muc", $data['ten_danh_muc']);
        $stmt->bindParam(":mo_ta", $data['mo_ta']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE categories SET ten_danh_muc = :ten_danh_muc, 
                  mo_ta = :mo_ta WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":ten_danh_muc", $data['ten_danh_muc']);
        $stmt->bindParam(":mo_ta", $data['mo_ta']);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}