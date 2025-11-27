class Dashboard {
    private $conn;

    public $tong_doanh_thu;
    public $so_don_hom_nay;
    public $so_ban_dang_su_dung;
    public $so_dat_ban_cho_xac_nhan;
    public $doanh_thu_thang;
    public $doanh_thu_ngay;

    public function __construct($db) {
        $this->conn = $db;
    }
}

