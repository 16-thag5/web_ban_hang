$title = isset($mon) ? "Sửa món ăn" : "Thêm món ăn";
include '../views/layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $title; ?></h4>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tên món <span class="text-danger">*</span></label>
                            <input type="text" name="ten_mon" class="form-control" 
                                   value="<?php echo $mon['ten_mon'] ?? ''; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giá (VNĐ) <span class="text-danger">*</span></label>
                            <input type="number" name="gia" class="form-control" 
                                   value="<?php echo $mon['gia'] ?? ''; ?>" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- Chọn danh mục --</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>" 
                                        <?php echo ($mon['category_id'] ?? '') == $cat['id'] ? 'selected' : ''; ?>>
                                        <?php echo $cat['ten_danh_muc']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select name="trang_thai" class="form-select">
                                <option value="con_hang" <?php echo ($mon['trang_thai'] ?? 'con_hang') == 'con_hang' ? 'selected' : ''; ?>>Còn hàng</option>
                                <option value="het_hang" <?php echo ($mon['trang_thai'] ?? '') == 'het_hang' ? 'selected' : ''; ?>>Hết hàng</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="mo_ta" class="form-control" rows="3"><?php echo $mon['mo_ta'] ?? ''; ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh</label>
                        <?php if (isset($mon['hinh_anh']) && $mon['hinh_anh']): ?>
                            <div class="mb-2">
                                <img src="uploads/<?php echo $mon['hinh_anh']; ?>" 
                                     alt="Current image" 
                                     style="max-width: 200px; height: auto; border-radius: 5px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="hinh_anh" class="form-control" accept="image/*">
                        <small class="text-muted">Chọn file ảnh mới nếu muốn thay đổi</small>
                    </div>
                    
                    <hr>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu
                    </button>
                    <a href="index.php?controller=mon&action=index" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../views/layouts/footer.php'; ?>

<?php