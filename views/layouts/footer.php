?>
    </div>
    
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Hệ thống quản lý nhà hàng. All rights reserved.</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?php

// ============= 8. views/dashboard.php =============
$title = "Trang chủ";
include '../views/layouts/header.php';
?>

<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-chair"></i> Tổng số bàn</h5>
                <h2><?php echo count($banDAO->getAll() ?? []); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-hamburger"></i> Món ăn</h5>
                <h2><?php echo count($monDAO->getAll() ?? []); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-receipt"></i> Đơn hàng hôm nay</h5>
                <h2>0</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-dollar-sign"></i> Doanh thu</h5>
                <h2>0đ</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-chart-line"></i> Trạng thái bàn</h5>
            </div>
            <div class="card-body">
                <canvas id="banChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-clock"></i> Đơn hàng gần đây</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Chưa có đơn hàng nào</p>
            </div>
        </div>
    </div>
</div>

<?php include '../views/layouts/footer.php'; ?>
<?php

// ============= 9. views/ban/index.php =============
$title = "Quản lý bàn";
include '../views/layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-chair"></i> Quản lý bàn</h2>
    <a href="index.php?controller=ban&action=create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Thêm bàn mới
    </a>
</div>

<div class="row">
    <?php foreach ($bans as $ban): ?>
    <div class="col-md-3 mb-3">
        <div class="card <?php 
            echo $ban['trang_thai'] == 'trong' ? 'border-success' : 
                ($ban['trang_thai'] == 'dang_su_dung' ? 'border-danger' : 'border-warning'); 
        ?>">
            <div class="card-body text-center">
                <h4><?php echo $ban['ten_ban']; ?></h4>
                <p class="mb-1"><i class="fas fa-users"></i> <?php echo $ban['so_cho']; ?> chỗ</p>
                <p class="mb-1"><i class="fas fa-map-marker-alt"></i> <?php echo $ban['khu_vuc']; ?></p>
                <span class="badge <?php 
                    echo $ban['trang_thai'] == 'trong' ? 'bg-success' : 
                        ($ban['trang_thai'] == 'dang_su_dung' ? 'bg-danger' : 'bg-warning'); 
                ?>">
                    <?php echo ucfirst(str_replace('_', ' ', $ban['trang_thai'])); ?>
                </span>
                <hr>
                <div class="btn-group" role="group">
                    <a href="index.php?controller=ban&action=edit&id=<?php echo $ban['id']; ?>" 
                       class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?controller=ban&action=delete&id=<?php echo $ban['id']; ?>" 
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Bạn có chắc muốn xóa?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include '../views/layouts/footer.php'; ?>
<?php
