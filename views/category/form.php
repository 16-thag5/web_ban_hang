$title = isset($category) ? "Sửa danh mục" : "Thêm danh mục";
include '../views/layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $title; ?></h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" name="ten_danh_muc" class="form-control" 
                               value="<?php echo $category['ten_danh_muc'] ?? ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="mo_ta" class="form-control" rows="3"><?php echo $category['mo_ta'] ?? ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu
                    </button>
                    <a href="index.php?controller=category&action=index" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../views/layouts/footer.php'; ?>
<?php