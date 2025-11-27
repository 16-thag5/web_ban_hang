$title = "Quản lý đơn hàng";
include '../views/layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-receipt"></i> Quản lý đơn hàng</h2>
    <a href="index.php?controller=order&action=create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tạo đơn mới
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bàn</th>
                        <th>Nhân viên</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><strong>#<?php echo $order['id']; ?></strong></td>
                        <td>
                            <i class="fas fa-chair"></i> 
                            <?php echo $order['ten_ban']; ?>
                        </td>
                        <td><?php echo $order['ho_ten']; ?></td>
                        <td><strong class="text-success"><?php echo number_format($order['tong_tien']); ?>đ</strong></td>
                        <td>
                            <?php
                            $status_class = [
                                'cho_xu_ly' => 'warning',
                                'dang_phuc_vu' => 'info',
                                'hoan_thanh' => 'success',
                                'huy' => 'danger'
                            ];
                            $status_text = [
                                'cho_xu_ly' => 'Chờ xử lý',
                                'dang_phuc_vu' => 'Đang phục vụ',
                                'hoan_thanh' => 'Hoàn thành',
                                'huy' => 'Đã hủy'
                            ];
                            ?>
                            <span class="badge bg-<?php echo $status_class[$order['trang_thai']]; ?>">
                                <?php echo $status_text[$order['trang_thai']]; ?>
                            </span>
                        </td>
                        <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                        <td>
                            <a href="index.php?controller=order&action=detail&id=<?php echo $order['id']; ?>" 
                               class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Chi tiết
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../views/layouts/footer.php'; ?>

<?php