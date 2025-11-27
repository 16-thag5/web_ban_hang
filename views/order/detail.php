$title = "Chi tiết đơn hàng #" . $order['id'];
include '../views/layouts/header.php';
?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-receipt"></i> Chi tiết đơn hàng #<?php echo $order['id']; ?></h4>
            </div>
            <div class="card-body">
                <!-- Thông tin đơn hàng -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Bàn:</strong> <?php echo $order['ten_ban']; ?></p>
                        <p><strong>Nhân viên:</strong> <?php echo $order['ho_ten']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Thời gian:</strong> <?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></p>
                        <p><strong>Trạng thái:</strong> 
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
                        </p>
                    </div>
                </div>

                <!-- Danh sách món -->
                <h5 class="border-bottom pb-2 mb-3">Danh sách món</h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Món</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                        <tr>
                            <td>
                                <?php if ($item['hinh_anh']): ?>
                                    <img src="uploads/<?php echo $item['hinh_anh']; ?>" 
                                         style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px;"
                                         class="me-2">
                                <?php endif; ?>
                                <strong><?php echo $item['ten_mon']; ?></strong>
                                <?php if ($item['ghi_chu']): ?>
                                    <br><small class="text-muted">Ghi chú: <?php echo $item['ghi_chu']; ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?php echo number_format($item['gia']); ?>đ</td>
                            <td><?php echo $item['so_luong']; ?></td>
                            <td><strong><?php echo number_format($item['gia'] * $item['so_luong']); ?>đ</strong></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                            <td><h5 class="text-success mb-0"><?php echo number_format($order['tong_tien']); ?>đ</h5></td>
                        </tr>
                    </tfoot>
                </table>

                <hr>
                <a href="index.php?controller=order&action=index" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button onclick="window.print()" class="btn btn-info">
                    <i class="fas fa-print"></i> In hóa đơn
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar: Cập nhật trạng thái -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit"></i> Cập nhật trạng thái</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?controller=order&action=updateStatus&id=<?php echo $order['id']; ?>">
                    <input type="hidden" name="tong_tien" value="<?php echo $order['tong_tien']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="trang_thai" class="form-select">
                            <option value="cho_xu_ly" <?php echo $order['trang_thai'] == 'cho_xu_ly' ? 'selected' : ''; ?>>
                                Chờ xử lý
                            </option>
                            <option value="dang_phuc_vu" <?php echo $order['trang_thai'] == 'dang_phuc_vu' ? 'selected' : ''; ?>>
                                Đang phục vụ
                            </option>
                            <option value="hoan_thanh" <?php echo $order['trang_thai'] == 'hoan_thanh' ? 'selected' : ''; ?>>
                                Hoàn thành
                            </option>
                            <option value="huy" <?php echo $order['trang_thai'] == 'huy' ? 'selected' : ''; ?>>
                                Hủy
                            </option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i> Cập nhật
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../views/layouts/footer.php'; ?>

<?php