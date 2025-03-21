<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5 cyber-container" style="position: relative; overflow: hidden;">
    <div class="cyber-overlay"
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(45deg, rgba(40, 30, 60, 0.8), rgba(138, 74, 243, 0.2)); z-index: 1; pointer-events: none;">
    </div>
    <div class="row mb-5 position-relative" style="z-index: 2;">
        <div class="col-12">
            <h1 class="display-3 text-center cyber-title"
                style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif; text-shadow: 0 0 10px rgb(138, 74, 243); animation: glow 2s infinite alternate;">
                Danh sách sản phẩm
            </h1>
            <div class="text-center mt-4">
                <a href="/webbanhang/Product/add" class="btn cyber-btn cyber-btn-success btn-lg px-5 me-3"
                    style="background: linear-gradient(135deg, rgb(40, 167, 69), rgb(80, 200, 120)); border: none; box-shadow: 0 0 15px rgba(40, 167, 69, 0.7); transition: all 0.3s ease;"
                    onmouseover="this.style.boxShadow='0 0 25px rgba(40, 167, 69, 1)'"
                    onmouseout="this.style.boxShadow='0 0 15px rgba(40, 167, 69, 0.7)'">
                    <i class="fas fa-plus"></i> Thêm sản phẩm mới
                </a>
                <a href="/webbanhang/Category" class="btn cyber-btn cyber-btn-primary btn-lg px-5"
                    style="background: linear-gradient(135deg, rgb(107, 62, 168), rgb(138, 74, 243)); border: none; box-shadow: 0 0 15px rgba(138, 74, 243, 0.7); transition: all 0.3s ease;"
                    onmouseover="this.style.boxShadow='0 0 25px rgba(138, 74, 243, 1)'"
                    onmouseout="this.style.boxShadow='0 0 15px rgba(138, 74, 243, 0.7)'">
                    <i class="fas fa-edit"></i> Chỉnh sửa thể loại
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4 cyber-grid" style="position: relative; z-index: 2;">
        <?php foreach ($products as $product): ?>
        <div class="col-12">
            <div class="card shadow-lg cyber-card"
                style="background: linear-gradient(135deg, rgb(40, 30, 60), rgb(60, 40, 90)); border: 3px solid rgb(138, 74, 243); box-shadow: 0 0 15px rgba(138, 74, 243, 0.5); transition: transform 0.3s ease;"
                onmouseover="this.style.transform='translateY(-10px)'"
                onmouseout="this.style.transform='translateY(0)'">
                <div class="row g-0">
                    <div class="col-md-3 cyber-image-container">
                        <?php if ($product->image): ?>
                        <img src="/webbanhang/<?php echo $product->image; ?>" class="img-fluid p-2" alt="Product Image"
                            style="object-fit: cover; height: 250px; border-right: 2px solid rgb(138, 74, 243); box-shadow: 0 0 10px rgba(138, 74, 243, 0.5);">
                        <?php else: ?>
                        <div class="text-center p-2"
                            style="height: 250px; background: url('https://via.placeholder.com/300x250.png?text=No+Image') no-repeat center; background-size: cover; border-right: 2px solid rgb(138, 74, 243); box-shadow: 0 0 10px rgba(138, 74, 243, 0.5);">
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3">
                                <a href="/webbanhang/Product/show/<?php echo $product->id; ?>"
                                    class="text-decoration-none cyber-text"
                                    style="color: rgb(200, 170, 255); font-size: 1.5rem; text-shadow: 0 0 5px rgba(200, 170, 255, 0.5);">
                                    <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            </h5>
                            <p class="card-text cyber-text"
                                style="color: rgb(180, 180, 200); min-height: 80px; font-size: 1.1rem;">
                                <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p class="card-text fw-bold cyber-text"
                                style="color: rgb(138, 74, 243); font-size: 1.2rem; text-shadow: 0 0 5px rgba(138, 74, 243, 0.3);">
                                Giá:
                                <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?> VND
                            </p>
                            <p class="card-text"><small class="cyber-text" style="color: rgb(150, 130, 180);">Danh mục:
                                    <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                                </small></p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <div class="card-footer bg-transparent border-0 p-4 w-100">
                            <div class="btn-group-vertical w-100 cyber-btn-group" role="group">
                                <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>"
                                    class="btn cyber-btn cyber-btn-warning mb-2"
                                    style="background: linear-gradient(135deg, rgb(255, 193, 7), rgb(255, 152, 0)); border: none; box-shadow: 0 0 10px rgba(255, 193, 7, 0.7);"><i
                                        class="fas fa-edit"></i> Sửa</a>
                                <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>"
                                    class="btn cyber-btn cyber-btn-danger mb-2"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');"
                                    style="background: linear-gradient(135deg, rgb(220, 53, 69), rgb(180, 40, 50)); border: none; box-shadow: 0 0 10px rgba(220, 53, 69, 0.7);"><i
                                        class="fas fa-trash"></i> Xóa</a>
                                <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>"
                                    class="btn cyber-btn cyber-btn-primary"
                                    style="background: linear-gradient(135deg, rgb(107, 62, 168), rgb(138, 74, 243)); border: none; box-shadow: 0 0 10px rgba(138, 74, 243, 0.7);"><i
                                        class="fas fa-cart-plus"></i> Thêm vào giỏ</a>
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