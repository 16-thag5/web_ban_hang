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
