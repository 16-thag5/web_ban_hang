class Category {
    private $conn;
    private $table = "categories";

    public $id;
    public $ten_danh_muc;
    public $mo_ta;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }
}