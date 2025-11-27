class MonController {
    private $monDAO;
    private $categoryDAO;

    public function __construct($db) {
        $this->monDAO = new MonDAO($db);
        $this->categoryDAO = new CategoryDAO($db);
    }

    public function index() {
        $mons = $this->monDAO->getAll();
        require_once '../views/mon/index.php';
    }

    public function create() {
        $categories = $this->categoryDAO->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hinh_anh = '';
            if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] == 0) {
                $target_dir = "../public/uploads/";
                $hinh_anh = time() . '_' . basename($_FILES["hinh_anh"]["name"]);
                move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_dir . $hinh_anh);
            }
            
            $data = [
                'ten_mon' => $_POST['ten_mon'],
                'gia' => $_POST['gia'],
                'category_id' => $_POST['category_id'],
                'mo_ta' => $_POST['mo_ta'] ?? '',
                'hinh_anh' => $hinh_anh,
                'trang_thai' => $_POST['trang_thai'] ?? 'con_hang'
            ];
            
            if ($this->monDAO->create($data)) {
                $_SESSION['success'] = "Thêm món ăn thành công!";
                header("Location: index.php?controller=mon&action=index");
                exit();
            }
        }
        require_once '../views/mon/form.php';
    }

    public function edit($id) {
        $mon = $this->monDAO->getById($id);
        $categories = $this->categoryDAO->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hinh_anh = $mon['hinh_anh'];
            if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] == 0) {
                $target_dir = "../public/uploads/";
                $hinh_anh = time() . '_' . basename($_FILES["hinh_anh"]["name"]);
                move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_dir . $hinh_anh);
            }
            
            $data = [
                'ten_mon' => $_POST['ten_mon'],
                'gia' => $_POST['gia'],
                'category_id' => $_POST['category_id'],
                'mo_ta' => $_POST['mo_ta'] ?? '',
                'hinh_anh' => $hinh_anh,
                'trang_thai' => $_POST['trang_thai']
            ];
            
            if ($this->monDAO->update($id, $data)) {
                $_SESSION['success'] = "Cập nhật món ăn thành công!";
                header("Location: index.php?controller=mon&action=index");
                exit();
            }
        }
        require_once '../views/mon/form.php';
    }

    public function delete($id) {
        if ($this->monDAO->delete($id)) {
            $_SESSION['success'] = "Xóa món ăn thành công!";
        }
        header("Location: index.php?controller=mon&action=index");
        exit();
    }
}