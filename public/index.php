session_start();
require_once '../config/Database.php';

// Autoload classes
spl_autoload_register(function ($class) {
    $paths = [
        '../models/',
        '../dao/',
        '../controllers/'
    ];
    
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Kết nối database
$database = new Database();
$db = $database->getConnection();

// Routing
$controller = $_GET['controller'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

try {
    switch ($controller) {
        case 'ban':
            $ctrl = new BanController($db);
            break;
        case 'category':
            $ctrl = new CategoryController($db);
            break;
        case 'order':
            $ctrl = new OrderController($db);
            break;
        default:
            require_once '../views/dashboard.php';
            exit();
    }

    if (method_exists($ctrl, $action)) {
        if ($id) {
            $ctrl->$action($id);
        } else {
            $ctrl->$action();
        }
    } else {
        echo "Action không tồn tại!";
    }
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}