class Order {
    private $conn;
    private $table = "orders";

    public $id;
    public $ban_id;
    public $user_id;
    public $tong_tien;
    public $trang_thai; // 'cho_xu_ly', 'dang_phuc_vu', 'hoan_thanh', 'huy'
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }
}