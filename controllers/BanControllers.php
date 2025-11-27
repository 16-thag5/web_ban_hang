class BanController {
    private $banDAO;

    public function __construct($db) {
        $this->banDAO = new BanDAO($db);
    }

    public function index() {
        $bans = $this->banDAO->getAll();
        require_once '../views/ban/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ten_ban' => $_POST['ten_ban'],
                'so_cho' => $_POST['so_cho'],
                'trang_thai' => $_POST['trang_thai'] ?? 'trong',
                'khu_vuc' => $_POST['khu_vuc']
            ];
            
            if ($this->banDAO->create($data)) {
                header("Location: index.php?controller=ban&action=index");
                exit();
            }
        }
        require_once '../views/ban/form.php';
    }

    public function edit($id) {
        $ban = $this->banDAO->getById($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ten_ban' => $_POST['ten_ban'],
                'so_cho' => $_POST['so_cho'],
                'trang_thai' => $_POST['trang_thai'],
                'khu_vuc' => $_POST['khu_vuc']
            ];
            
            if ($this->banDAO->update($id, $data)) {
                header("Location: index.php?controller=ban&action=index");
                exit();
            }
        }
        require_once '../views/ban/form.php';
    }

    public function delete($id) {
        $this->banDAO->delete($id);
        header("Location: index.php?controller=ban&action=index");
        exit();
    }
}