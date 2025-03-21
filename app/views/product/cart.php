<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5 cyber-container" style="position: relative; overflow: hidden;">
    <div class="cyber-overlay"
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(45deg, rgba(40, 30, 60, 0.8), rgba(138, 74, 243, 0.2)); z-index: 1; pointer-events: none;">
    </div>
    <h1 class="display-3 text-center mb-5 cyber-title"
        style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif; text-shadow: 0 0 10px rgb(138, 74, 243); animation: glow 2s infinite alternate; position: relative; z-index: 2;">
        Giỏ hàng
    </h1>

    <ul class="list-group mb-5 cyber-list" style="position: relative; z-index: 2;">
        <?php if (!empty($cart)): ?>
        <?php foreach ($cart as $id => $item): ?>
        <li class="list-group-item d-flex align-items-center cyber-item mb-3"
            style="background: linear-gradient(135deg, rgb(40, 30, 60), rgb(60, 40, 90)); border: 3px solid rgb(138, 74, 243); color: rgb(180, 180, 200); box-shadow: 0 0 15px rgba(138, 74, 243, 0.5); transition: transform 0.3s ease;"
            onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div class="me-4 cyber-image-container">
                <?php if ($item['image']): ?>
                <img src="/webbanhang/<?php echo $item['image']; ?>" alt="Product Image"
                    style="max-width: 120px; border-radius: 8px; box-shadow: 0 0 10px rgba(138, 74, 243, 0.5);">
                <?php else: ?>
                <div
                    style="width: 120px; height: 120px; background: url('https://via.placeholder.com/120x120.png?text=No+Image') no-repeat center; background-size: cover; border-radius: 8px; box-shadow: 0 0 10px rgba(138, 74, 243, 0.5);">
                </div>
                <?php endif; ?>
            </div>
            <div class="flex-grow-1 ms-4">
                <h2 class="fs-3 cyber-text"
                    style="color: rgb(200, 170, 255); text-shadow: 0 0 5px rgba(200, 170, 255, 0.5);">
                    <?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>
                </h2>
                <p class="mb-2 cyber-text"
                    style="color: rgb(138, 74, 243); font-weight: bold; text-shadow: 0 0 5px rgba(138, 74, 243, 0.3);">
                    Giá đơn vị:
                    <?php echo htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8'); ?> VND
                </p>
                <p class="mb-2 total-price cyber-text"
                    data-price="<?php echo htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8'); ?>"
                    style="color: rgb(138, 74, 243); font-weight: bold; text-shadow: 0 0 5px rgba(138, 74, 243, 0.3);">
                    Tổng giá:
                    <?php echo htmlspecialchars($item['total_price'] ?? $item['price'] * $item['quantity'], ENT_QUOTES, 'UTF-8'); ?>
                    VND
                </p>
                <div class="d-flex align-items-center cyber-quantity">
                    <span class="me-3 cyber-text" style="color: rgb(200, 170, 255);">Số lượng:</span>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn cyber-btn cyber-btn-secondary btn-sm"
                            onclick="updateQuantity('<?php echo $id; ?>', -1, this)"
                            style="background: linear-gradient(135deg, rgb(90, 80, 120), rgb(60, 40, 90)); border: none; box-shadow: 0 0 10px rgba(90, 80, 120, 0.7);">-</button>
                        <input type="number" name="quantity"
                            value="<?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>" min="1"
                            class="form-control mx-2 cyber-input"
                            style="width: 70px; text-align: center; background: rgba(70, 60, 100, 0.9); border: 2px solid rgb(138, 74, 243); color: rgb(200, 200, 220); box-shadow: inset 0 0 10px rgba(138, 74, 243, 0.3);"
                            readonly>
                        <button type="button" class="btn cyber-btn cyber-btn-secondary btn-sm"
                            onclick="updateQuantity('<?php echo $id; ?>', 1, this)"
                            style="background: linear-gradient(135deg, rgb(90, 80, 120), rgb(60, 40, 90)); border: none; box-shadow: 0 0 10px rgba(90, 80, 120, 0.7);">+</button>
                    </div>
                </div>
            </div>
            <a href="/webbanhang/Product/removeFromCart/<?php echo $id; ?>"
                class="btn cyber-btn cyber-btn-danger btn-sm ms-4"
                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?');"
                style="background: linear-gradient(135deg, rgb(220, 53, 69), rgb(180, 40, 50)); border: none; box-shadow: 0 0 15px rgba(220, 53, 69, 0.7); transition: all 0.3s ease;"
                onmouseover="this.style.boxShadow='0 0 25px rgba(220, 53, 69, 1)'"
                onmouseout="this.style.boxShadow='0 0 15px rgba(220, 53, 69, 0.7)'">
                <i class="fas fa-trash"></i> Xóa
            </a>
        </li>
        <?php endforeach; ?>
        <?php else: ?>
        <li class="list-group-item text-center cyber-item"
            style="background: linear-gradient(135deg, rgb(40, 30, 60), rgb(60, 40, 90)); border: 3px solid rgb(138, 74, 243); color: rgb(180, 180, 200); font-size: 1.5rem; box-shadow: 0 0 15px rgba(138, 74, 243, 0.5);">
            Giỏ hàng của bạn đang trống.
        </li>
        <?php endif; ?>
    </ul>

    <div class="text-center mt-5" style="position: relative; z-index: 2;">
        <a href="/webbanhang/Product" class="btn cyber-btn cyber-btn-secondary btn-lg px-5 me-3"
            style="background: linear-gradient(135deg, rgb(90, 80, 120), rgb(60, 40, 90)); border: none; box-shadow: 0 0 15px rgba(90, 80, 120, 0.7); transition: all 0.3s ease;"
            onmouseover="this.style.boxShadow='0 0 25px rgba(90, 80, 120, 1)'"
            onmouseout="this.style.boxShadow='0 0 15px rgba(90, 80, 120, 0.7)'">
            Tiếp tục mua sắm
        </a>
        <?php if (!empty($cart)): ?>
        <a href="/webbanhang/Product/checkout" class="btn cyber-btn cyber-btn-primary btn-lg px-5"
            style="background: linear-gradient(135deg, rgb(107, 62, 168), rgb(138, 74, 243)); border: none; box-shadow: 0 0 15px rgba(138, 74, 243, 0.7); transition: all 0.3s ease;"
            onmouseover="this.style.boxShadow='0 0 25px rgba(138, 74, 243, 1)'"
            onmouseout="this.style.boxShadow='0 0 15px rgba(138, 74, 243, 0.7)'">
            Thanh toán
        </a>
        <?php endif; ?>
    </div>
</div>

<script>
function updateQuantity(id, change, button) {
    const input = button.parentElement.querySelector('input[name="quantity"]');
    const totalPriceElement = button.closest('.flex-grow-1').querySelector('.total-price');
    const unitPrice = parseInt(totalPriceElement.getAttribute('data-price'));
    let quantity = parseInt(input.value) + change;

    if (quantity < 1) quantity = 1;
    const totalPrice = unitPrice * quantity;

    fetch('/webbanhang/Product/updateCart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id=' + encodeURIComponent(id) + '&quantity=' + encodeURIComponent(quantity) + '&total_price=' +
                encodeURIComponent(totalPrice)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                input.value = quantity;
                totalPriceElement.textContent = 'Tổng giá: ' + totalPrice + ' VND';
                totalPriceElement.style.animation = 'priceUpdate 0.5s ease';
            } else {
                alert('Cập nhật số lượng thất bại!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi khi cập nhật số lượng!');
        });
}
</script>

<style>
@keyframes priceUpdate {
    0% {
        transform: scale(1);
        opacity: 0.5;
    }

    50% {
        transform: scale(1.1);
        opacity: 1;
    }

    100% {
        transform: scale(1);
        opacity: 1;
    }
}
</style>

<?php include 'app/views/shares/footer.php'; ?>