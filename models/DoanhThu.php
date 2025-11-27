class DoanhThu {
    private $conn;
    private $table = "orders";

    public $id;
    public $tong_tien;
    public $ngay;
    public $thang;
    public $nam;
    public $so_don;
    public $trang_thai;

    public function __construct($db) {
        $this->conn = $db;
    }
}

