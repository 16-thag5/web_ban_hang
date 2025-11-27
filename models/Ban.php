class Ban {
    private $conn;
    private $table = "ban";

    public $id;
    public $ten_ban;
    public $so_cho;
    public $trang_thai; // 'trong', 'dang_su_dung', 'dat_truoc'
    public $khu_vuc;

    public function __construct($db) {
        $this->conn = $db;
    }
}