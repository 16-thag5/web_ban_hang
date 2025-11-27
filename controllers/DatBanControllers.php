class DatBanController {
    private $datbanDAO;
    private $banDAO;

    public function __construct($db) {
        $this->datbanDAO = new DatBanDAO($db);
        $this->banDAO = new BanDAO($db);
    }

    public function index() {
        $datbans = $this->datbanDAO->getAll();
        require_once '../views/datban/index.php';
    }

    public function create() {
        $bans = $this->banDAO->getBanTrong();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ban_id' => $_POST['ban_id'],
                'ten_khach' => $_POST['ten_khach'],
                'sdt' => $_POST['sdt'],
                'thoi_gian' => $_POST['thoi_gian'],
                'so_nguoi' => $_POST['so_nguoi'],
                'ghi_chu' => $_POST['ghi_chu'] ?? '',
                'trang_thai' => 'cho_xac_nhan'
            ];
            
            if ($this->datbanDAO->create($data)) {
                $_SESSION['success'] = "Đặt bàn thành công!";
                header("Location: index.php?controller=datban&action=index");
                exit();
            }
        }
        require_once '../views/datban/form.php';
    }

    public function updateStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['trang_thai' => $_POST['trang_thai']];
            
            if ($this->datbanDAO->update($id, $data)) {
                $_SESSION['success'] = "Cập nhật trạng thái thành công!";
            }
        }
        header("Location: index.php?controller=datban&action=index");
        exit();
    }
}
?>