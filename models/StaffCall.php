class StaffCall {
    private $conn;
    private $table = "staff_calls";

    public $id;
    public $ban_id;
    public $user_id;
    public $loai_yeu_cau; // 'goi_phuc_vu', 'thanh_toan', 'ho_tro'
    public $trang_thai; // 'cho_xu_ly', 'da_xu_ly'
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }
}

