class DatBan {
    private $conn;
    private $table = "dat_ban";

    public $id;
    public $ban_id;
    public $ten_khach;
    public $sdt;
    public $thoi_gian;
    public $so_nguoi;
    public $ghi_chu;
    public $trang_thai; // 'cho_xac_nhan', 'da_xac_nhan', 'huy'
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }
}

