class OrderController {
    private $orderDAO;
    private $banDAO;
    private $monDAO;
    private $orderItemDAO;

    public function __construct($db) {
        $this->orderDAO = new OrderDAO($db);
        $this->banDAO = new BanDAO($db);
        $this->monDAO = new MonDAO($db);
        $this->orderItemDAO = new OrderItemDAO($db);
    }

    public function index() {
        $orders = $this->orderDAO->getAll();
        require_once '../views/order/index.php';
    }

    public function create() {
        $bans = $this->banDAO->getBanTrong();
        $categories = (new CategoryDAO($GLOBALS['db']))->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ban_id' => $_POST['ban_id'],
                'user_id' => $_SESSION['user_id'] ?? 1,
                'tong_tien' => 0,
                'trang_thai' => 'cho_xu_ly'
            ];
            
            $order_id = $this->orderDAO->create($data);
            
            if ($order_id && isset($_POST['items'])) {
                $tong_tien = 0;
                foreach ($_POST['items'] as $item) {
                    if ($item['so_luong'] > 0) {
                        $mon = $this->monDAO->getById($item['mon_id']);
                        $item_data = [
                            'order_id' => $order_id,
                            'mon_id' => $item['mon_id'],
                            'so_luong' => $item['so_luong'],
                            'gia' => $mon['gia'],
                            'ghi_chu' => $item['ghi_chu'] ?? ''
                        ];
                        $this->orderItemDAO->create($item_data);
                        $tong_tien += $mon['gia'] * $item['so_luong'];
                    }
                }
                
                $this->orderDAO->update($order_id, [
                    'tong_tien' => $tong_tien,
                    'trang_thai' => 'cho_xu_ly'
                ]);
                
                $this->banDAO->update($_POST['ban_id'], [
                    'ten_ban' => '', 
                    'so_cho' => 0,
                    'trang_thai' => 'dang_su_dung',
                    'khu_vuc' => ''
                ]);
                
                $_SESSION['success'] = "Tạo đơn hàng thành công!";
                header("Location: index.php?controller=order&action=detail&id=" . $order_id);
                exit();
            }
        }
        require_once '../views/order/create.php';
    }

    public function detail($id) {
        $order = $this->orderDAO->getById($id);
        $items = $this->orderItemDAO->getByOrderId($id);
        require_once '../views/order/detail.php';
    }

    public function updateStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'trang_thai' => $_POST['trang_thai'],
                'tong_tien' => $_POST['tong_tien']
            ];
            
            if ($this->orderDAO->update($id, $data)) {
                if ($_POST['trang_thai'] == 'hoan_thanh') {
                    $order = $this->orderDAO->getById($id);
                    $this->banDAO->update($order['ban_id'], [
                        'ten_ban' => '',
                        'so_cho' => 0,
                        'trang_thai' => 'trong',
                        'khu_vuc' => ''
                    ]);
                }
                $_SESSION['success'] = "Cập nhật trạng thái thành công!";
            }
        }
        header("Location: index.php?controller=order&action=detail&id=" . $id);
        exit();
    }
}