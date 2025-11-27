class User {
    private $conn;
    private $table = "users";

    public $id;
    public $ho_ten;
    public $email;
    public $password;
    public $vai_tro; // 'admin', 'nhan_vien', 'bep'
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }
}

