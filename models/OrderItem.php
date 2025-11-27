class OrderItem {
    private $conn;
    private $table = "order_items";

    public $id;
    public $order_id;
    public $mon_id;
    public $so_luong;
    public $gia;
    public $ghi_chu;

    public function __construct($db) {
        $this->conn = $db;
    }
}

