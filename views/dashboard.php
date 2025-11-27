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