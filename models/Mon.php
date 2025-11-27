class Mon {
    private $conn;
    private $table = "mon";

    public $id;
    public $ten_mon;
    public $gia;
    public $category_id;
    public $mo_ta;
    public $hinh_anh;
    public $trang_thai; // 'con_hang', 'het_hang'

    public function __construct($db) {
        $this->conn = $db;
    }
}