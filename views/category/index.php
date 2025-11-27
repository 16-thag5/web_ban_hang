$title = "Quản lý danh mục";
include '../views/layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-list"></i> Quản lý danh mục</h2>
    <a href="index.php?controller=category&action=create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Thêm danh mục
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?php echo $cat['id']; ?></td>
                    <td><strong><?php echo $cat['ten_danh_muc']; ?></strong></td>
                    <td><?php echo $cat['mo_ta']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($cat['created_at'])); ?></td>
                    <td>
                        <a href="index.php?controller=category&action=edit&id=<?php echo $cat['id']; ?>" 
                           class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?controller=category&action=delete&id=<?php echo $cat['id']; ?>" 
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

<?php include '../views/layouts/footer.php'; ?>
<?php