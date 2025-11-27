$title = "Tạo đơn hàng mới";
include '../views/layouts/header.php';
?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-shopping-cart"></i> Chọn món</h4>
            </div>
            <div class="card-body">
                <form method="POST" id="orderForm">
                    <!-- Chọn bàn -->
                    <div class="mb-4">
                        <label class="form-label"><strong>Chọn bàn <span class="text-danger">*</span></strong></label>
                        <select name="ban_id" class="form-select" required>
                            <option value="">-- Chọn bàn --</option>
                            <?php foreach ($bans as $ban): ?>
                                <option value="<?php echo $ban['id']; ?>">
                                    <?php echo $ban['ten_ban']; ?> 
                                    (<?php echo $ban['so_cho']; ?> chỗ - <?php echo $ban['khu_vuc']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Danh sách món theo category -->
                    <div class="menu-items">
                        <?php 
                        $monDAO = new MonDAO($GLOBALS['db']);
                        foreach ($categories as $cat): 
                            $mons = $monDAO->getByCategory($cat['id']);
                            if (count($mons) > 0):
                        ?>
                        <div class="mb-4">
                            <h5 class="text-primary border-bottom pb-2">
                                <i class="fas fa-utensils"></i> <?php echo $cat['ten_danh_muc']; ?>
                            </h5>
                            <div class="row">
                                <?php foreach ($mons as $mon): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <?php if ($mon['hinh_anh']): ?>
                                                    <img src="uploads/<?php echo $mon['hinh_anh']; ?>" 
                                                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;"
                                                         alt="<?php echo $mon['ten_mon']; ?>">
                                                <?php else: ?>
                                                    <div style="width: 80px; height: 80px; background: #f0f0f0; border-radius: 5px; 
                                                                display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <div class="ms-3 flex-grow-1">
                                                    <h6 class="mb-1"><?php echo $mon['ten_mon']; ?></h6>
                                                    <p class="text-success mb-2">
                                                        <strong><?php echo number_format($mon['gia']); ?>đ</strong>
                                                    </p>
                                                    <div class="input-group input-group-sm">
                                                        <button type="button" class="btn btn-outline-secondary btn-minus" 
                                                                data-id="<?php echo $mon['id']; ?>">-</button>
                                                        <input type="number" 
                                                               name="items[<?php echo $mon['id']; ?>][so_luong]" 
                                                               class="form-control text-center item-quantity" 
                                                               value="0" min="0"
                                                               data-id="<?php echo $mon['id']; ?>"
                                                               data-price="<?php echo $mon['gia']; ?>">
                                                        <input type="hidden" 
                                                               name="items[<?php echo $mon['id']; ?>][mon_id]" 
                                                               value="<?php echo $mon['id']; ?>">
                                                        <button type="button" class="btn btn-outline-secondary btn-plus"
                                                                data-id="<?php echo $mon['id']; ?>">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-check"></i> Tạo đơn hàng
                        </button>
                        <a href="index.php?controller=order&action=index" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar: Tổng đơn hàng -->
    <div class="col-md-4">
        <div class="card sticky-top" style="top: 20px;">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-file-invoice"></i> Tổng đơn hàng</h5>
            </div>
            <div class="card-body">
                <div id="orderSummary">
                    <p class="text-muted text-center">Chưa có món nào được chọn</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tổng cộng:</h5>
                    <h4 class="mb-0 text-success" id="totalPrice">0đ</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantities = document.querySelectorAll('.item-quantity');
    const btnPlus = document.querySelectorAll('.btn-plus');
    const btnMinus = document.querySelectorAll('.btn-minus');
    
    // Cập nhật tổng tiền
    function updateTotal() {
        let total = 0;
        let summary = '';
        let hasItems = false;
        
        quantities.forEach(input => {
            const qty = parseInt(input.value) || 0;
            const price = parseFloat(input.dataset.price) || 0;
            
            if (qty > 0) {
                hasItems = true;
                const itemName = input.closest('.card-body').querySelector('h6').textContent;
                const itemTotal = qty * price;
                total += itemTotal;
                
                summary += `
                    <div class="d-flex justify-content-between mb-2">
                        <span>${itemName} x${qty}</span>
                        <strong>${itemTotal.toLocaleString('vi-VN')}đ</strong>
                    </div>
                `;
            }
        });
        
        document.getElementById('orderSummary').innerHTML = hasItems ? summary : 
            '<p class="text-muted text-center">Chưa có món nào được chọn</p>';
        document.getElementById('totalPrice').textContent = total.toLocaleString('vi-VN') + 'đ';
    }
    
    // Nút +
    btnPlus.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const input = document.querySelector(`.item-quantity[data-id="${id}"]`);
            input.value = parseInt(input.value) + 1;
            updateTotal();
        });
    });
    
    // Nút -
    btnMinus.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const input = document.querySelector(`.item-quantity[data-id="${id}"]`);
            if (parseInt(input.value) > 0) {
                input.value = parseInt(input.value) - 1;
                updateTotal();
            }
        });
    });
    
    // Khi nhập trực tiếp
    quantities.forEach(input => {
        input.addEventListener('input', updateTotal);
    });
});
</script>

<?php include '../views/layouts/footer.php'; ?>

<?php