<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-4 text-center" style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif;">
                Danh sách sản phẩm
            </h1>
            <div class="text-center mb-3">
                <a href="/webbanhang/Product/add" class="btn btn-success btn-lg shadow-sm me-2">
                    <i class="fas fa-plus"></i> Thêm sản phẩm mới
                </a>
                <a href="/webbanhang/Category" class="btn btn-primary btn-lg shadow-sm">
                    <i class="fas fa-edit"></i> Chỉnh sửa thể loại
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <?php foreach ($products as $product): ?>
        <div class="col-12">
            <div class="card shadow-sm"
                style="background: linear-gradient(135deg, rgb(40, 30, 60) 0%, rgb(60, 40, 90) 100%); border: 2px solid rgb(138, 74, 243);">
                <div class="row g-0">
                    <!-- Product Image or Placeholder -->
                    <div class="col-md-3">
                        <?php if ($product->image): ?>
                        <img src="/webbanhang/<?php echo $product->image; ?>" class="img-fluid p-2" alt="Product Image"
                            style="object-fit: cover; height: 200px; border-right: 1px solid rgb(138, 74, 243);">
                        <?php else: ?>
                        <div class="text-center p-2"
                            style="height: 200px; background: url('https://via.placeholder.com/300x250.png?text=Castorice+Style') no-repeat center; background-size: cover; border-right: 1px solid rgb(138, 74, 243);">
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Info -->
                    <div class="col-md-6">
                        <div class="card-body p-3">
                            <h5 class="card-title mb-3">
                                <a href="/webbanhang/Product/show/<?php echo $product->id; ?>"
                                    class="text-decoration-none" style="color: rgb(200, 170, 255); font-size: 1.25rem;">
                                    <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            </h5>
                            <p class="card-text" style="color: rgb(180, 180, 200); min-height: 60px; font-size: 1rem;">
                                <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p class="card-text fw-bold" style="color: rgb(138, 74, 243); font-size: 1.1rem;">
                                Giá:
                                <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?> VND
                            </p>
                            <p class="card-text">
                                <small style="color: rgb(150, 130, 180);">
                                    Danh mục:
                                    <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                                </small>
                            </p>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-3 d-flex align-items-center">
                        <div class="card-footer bg-transparent border-0 p-3 w-100">
                            <div class="btn-group w-100" role="group">
                                <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>"
                                    class="btn btn-warning px-3">
                                    <i class="fas fa-edit"></i> Sửa thông tin
                                </a>
                                <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>"
                                    class="btn btn-danger px-3"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                    <i class="fas fa-trash"></i> Xóa sản phẩm
                                </a>
                                <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>"
                                    class="btn btn-primary px-3">
                                    <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>