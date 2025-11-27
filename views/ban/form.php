$title = isset($ban) ? "Sửa bàn" : "Thêm bàn";
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
                        <label class="form-label">Tên bàn</label>
                        <input type="text" name="ten_ban" class="form-control" 
                               value="<?php echo $ban['ten_ban'] ?? ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số chỗ</label>
                        <input type="number" name="so_cho" class="form-control" 
                               value="<?php echo $ban['so_cho'] ?? ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Khu vực</label>
                        <input type="text" name="khu_vuc" class="form-control" 
                               value="<?php echo $ban['khu_vuc'] ?? ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="trang_thai" class="form-select">
                            <option value="trong" <?php echo ($ban['trang_thai'] ?? '') == 'trong' ? 'selected' : ''; ?>>Trống</option>
                            <option value="dang_su_dung" <?php echo ($ban['trang_thai'] ?? '') == 'dang_su_dung' ? 'selected' : ''; ?>>Đang sử dụng</option>
                            <option value="dat_truoc" <?php echo ($ban['trang_thai'] ?? '') == 'dat_truoc' ? 'selected' : ''; ?>>Đặt trước</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu
                    </button>
                    <a href="index.php?controller=ban&action=index" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../views/layouts/footer.php'; ?><?php
