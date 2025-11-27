$title = "Quản lý món ăn";
include '../views/layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-hamburger"></i> Quản lý món ăn</h2>
    <a href="index.php?controller=mon&action=create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Thêm món mới
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên món</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mons as $mon): ?>
                    <tr>
                        <td>
                            <?php if ($mon['hinh_anh']): ?>
                                <img src="uploads/<?php echo $mon['hinh_anh']; ?>" 
                                     alt="<?php echo $mon['ten_mon']; ?>" 
                                     style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                            <?php else: ?>
                                <div style="width: 60px; height: 60px; background: #ddd; border-radius: 5px; 
                                            display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><strong><?php echo $mon['ten_mon']; ?></strong></td>
                        <td>
                            <span class="badge bg-info">
                                <?php echo $mon['ten_danh_muc'] ?? 'Chưa phân loại'; ?>
                            </span>
                        </td>
                        <td><strong><?php echo number_format($mon['gia']); ?>đ</strong></td>
                        <td>
                            <span class="badge <?php echo $mon['trang_thai'] == 'con_hang' ? 'bg-success' : 'bg-danger'; ?>">
                                <?php echo $mon['trang_thai'] == 'con_hang' ? 'Còn hàng' : 'Hết hàng'; ?>
                            </span>
                        </td>
                        <td>
                            <a href="index.php?controller=mon&action=edit&id=<?php echo $mon['id']; ?>" 
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?controller=mon&action=delete&id=<?php echo $mon['id']; ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Bạn có chắc muốn xóa?')">
                                <i class="fas fa-trash"></i>
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