<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <h1 class="display-4 text-center" style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif;">Giỏ hàng</h1>

    <ul class="list-group mb-4">
        <?php if (!empty($cart)): ?>
        <?php foreach ($cart as $id => $item): ?>
        <li class="list-group-item d-flex align-items-center"
            style="background: linear-gradient(135deg, rgb(40, 30, 60) 0%, rgb(60, 40, 90) 100%); border: 2px solid rgb(138, 74, 243); color: rgb(180, 180, 200);">
            <div class="me-3">
                <?php if ($item['image']): ?>
                <img src="/webbanhang/<?php echo $item['image']; ?>" alt="Product Image"
                    style="max-width: 100px; border-radius: 5px;">
                <?php else: ?>
                <div
                    style="width: 100px; height: 100px; background: url('https://via.placeholder.com/100x100.png?text=No+Image') no-repeat center; background-size: cover; border-radius: 5px;">
                </div>
                <?php endif; ?>
            </div>
            <div class="flex-grow-1 ms-4">
                <!-- Tăng khoảng cách bằng ms-4 -->
                <h2 class="fs-4" style="color: rgb(200, 170, 255);">
                    <?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>
                </h2>
                <p class="mb-1" style="color: rgb(138, 74, 243); font-weight: bold;">
                    Giá đơn vị:
                    <?php echo htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8'); ?> VND
                </p>
                <p class="mb-1 total-price"
                    data-price="<?php echo htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8'); ?>"
                    style="color: rgb(138, 74, 243); font-weight: bold;">
                    Tổng giá:
                    <?php echo htmlspecialchars($item['total_price'] ?? $item['price'] * $item['quantity'], ENT_QUOTES, 'UTF-8'); ?>
                    VND
                </p>
                <div class="d-flex align-items-center">
                    <span class="me-2">Số lượng:</span>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-outline-secondary btn-sm"
                            onclick="updateQuantity('<?php echo $id; ?>', -1, this)">-</button>
                        <input type="number" name="quantity"
                            value="<?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>" min="1"
                            class="form-control mx-2" style="width: 60px; text-align: center;" readonly>
                        <button type="button" class="btn btn-outline-secondary btn-sm"
                            onclick="updateQuantity('<?php echo $id; ?>', 1, this)">+</button>
                    </div>
                </div>
            </div>
            <a href="/webbanhang/Product/removeFromCart/<?php echo $id; ?>" class="btn btn-danger btn-sm ms-3"
                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?');">
                <i class="fas fa-trash"></i> Xóa
            </a>
        </li>
        <?php endforeach; ?>
        <?php else: ?>
        <li class="list-group-item text-center"
            style="background: linear-gradient(135deg, rgb(40, 30, 60) 0%, rgb(60, 40, 90) 100%); border: 2px solid rgb(138, 74, 243); color: rgb(180, 180, 200); font-size: 1.2rem;">
            Giỏ hàng của bạn đang trống.
        </li>
        <?php endif; ?>
    </ul>

    <div class="text-center">
        <a href="/webbanhang/Product" class="btn btn-secondary btn-lg shadow-sm me-2">Tiếp tục mua sắm</a>
        <?php if (!empty($cart)): ?>
        <a href="/webbanhang/Product/checkout" class="btn btn-primary btn-lg shadow-sm">Thanh toán</a>
        <?php endif; ?>
    </div>
</div>

<script>
function updateQuantity(id, change, button) {
    const input = button.parentElement.querySelector('input[name="quantity"]');
    const totalPriceElement = button.closest('.flex-grow-1').querySelector('.total-price');
    const unitPrice = parseInt(totalPriceElement.getAttribute('data-price'));
    let quantity = parseInt(input.value) + change;

    if (quantity < 1) quantity = 1; // Không cho phép nhỏ hơn 1
    const totalPrice = unitPrice * quantity; // Tính tổng giá

    // Gửi yêu cầu AJAX để cập nhật số lượng và tổng giá
    fetch('/webbanhang/Product/updateCart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + encodeURIComponent(id) + '&quantity=' + encodeURIComponent(quantity) + '&total_price=' +
                encodeURIComponent(totalPrice)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                input.value = quantity; // Cập nhật số lượng trên giao diện
                totalPriceElement.textContent = 'Tổng giá: ' + totalPrice + ' VND'; // Cập nhật tổng giá
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

<?php include 'app/views/shares/footer.php'; ?>