class CategoryController {
    private $categoryDAO;

    public function __construct($db) {
        $this->categoryDAO = new CategoryDAO($db);
    }

    public function index() {
        $categories = $this->categoryDAO->getAll();
        require_once '../views/category/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ten_danh_muc' => $_POST['ten_danh_muc'],
                'mo_ta' => $_POST['mo_ta'] ?? ''
            ];
            
            if ($this->categoryDAO->create($data)) {
                $_SESSION['success'] = "Thêm danh mục thành công!";
                header("Location: index.php?controller=category&action=index");
                exit();
            }
        }
        require_once '../views/category/form.php';
    }

    public function edit($id) {
        $category = $this->categoryDAO->getById($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ten_danh_muc' => $_POST['ten_danh_muc'],
                'mo_ta' => $_POST['mo_ta'] ?? ''
            ];
            
            if ($this->categoryDAO->update($id, $data)) {
                $_SESSION['success'] = "Cập nhật danh mục thành công!";
                header("Location: index.php?controller=category&action=index");
                exit();
            }
        }
        require_once '../views/category/form.php';
    }

    public function delete($id) {
        if ($this->categoryDAO->delete($id)) {
            $_SESSION['success'] = "Xóa danh mục thành công!";
        }
        header("Location: index.php?controller=category&action=index");
        exit();
    }
}