CREATE DATABASE restaurant_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE restaurant_db;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ho_ten VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    vai_tro ENUM('admin', 'nhan_vien', 'bep') DEFAULT 'nhan_vien',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_danh_muc VARCHAR(100) NOT NULL,
    mo_ta TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ban (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_ban VARCHAR(50) NOT NULL,
    so_cho INT NOT NULL,
    trang_thai ENUM('trong', 'dang_su_dung', 'dat_truoc') DEFAULT 'trong',
    khu_vuc VARCHAR(50)
);

CREATE TABLE mon (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_mon VARCHAR(100) NOT NULL,
    gia DECIMAL(10,2) NOT NULL,
    category_id INT,
    mo_ta TEXT,
    hinh_anh VARCHAR(255),
    trang_thai ENUM('con_hang', 'het_hang') DEFAULT 'con_hang',
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ban_id INT,
    user_id INT,
    tong_tien DECIMAL(10,2),
    trang_thai ENUM('cho_xu_ly', 'dang_phuc_vu', 'hoan_thanh', 'huy') DEFAULT 'cho_xu_ly',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ban_id) REFERENCES ban(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    mon_id INT,
    so_luong INT NOT NULL,
    gia DECIMAL(10,2) NOT NULL,
    ghi_chu TEXT,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (mon_id) REFERENCES mon(id)
);

CREATE TABLE dat_ban (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ban_id INT,
    ten_khach VARCHAR(100),
    sdt VARCHAR(20),
    thoi_gian DATETIME,
    so_nguoi INT,
    ghi_chu TEXT,
    trang_thai ENUM('cho_xac_nhan', 'da_xac_nhan', 'huy') DEFAULT 'cho_xac_nhan',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ban_id) REFERENCES ban(id)
);

