<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5 cyber-container" style="position: relative; overflow: hidden;">
    <div class="cyber-overlay"
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(45deg, rgba(40, 30, 60, 0.8), rgba(138, 74, 243, 0.2)); z-index: 1; pointer-events: none;">
    </div>
    <div class="row justify-content-center position-relative" style="z-index: 2;">
        <div class="col-12 col-lg-10">
            <h1 class="display-3 text-center mb-5 cyber-title"
                style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif; text-shadow: 0 0 10px rgb(138, 74, 243); animation: glow 2s infinite alternate;">
                Sửa sản phẩm
            </h1>

            <!-- Error Messages -->
            <?php if (!empty($errors)): ?>
            <div class="alert alert-danger shadow-lg cyber-alert"
                style="background: linear-gradient(135deg, rgb(60, 20, 40), rgb(80, 30, 50)); border: 2px solid rgb(220, 53, 69); color: rgb(255, 200, 200); transform: translateY(-10px); animation: slideIn 0.5s ease-out;">
                <ul class="mb-0 ps-4">
                    <?php foreach ($errors as $error): ?>
                    <li class="cyber-text" style="text-shadow: 0 0 5px rgba(255, 200, 200, 0.5);">
                        <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Form -->
            <form method="POST" action="/webbanhang/Product/update" enctype="multipart/form-data"
                onsubmit="return validateForm();" class="p-5 rounded cyber-form"
                style="background: linear-gradient(135deg, rgb(40, 30, 60), rgb(60, 40, 90)); border: 3px solid rgb(138, 74, 243); box-shadow: 0 0 20px rgba(138, 74, 243, 0.5);">
                <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                <div class="row g-4">
                    <div class="col-md-6 form-group cyber-input-group">
                        <label for="name" class="cyber-label"
                            style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Tên sản
                            phẩm:</label>
                        <input type="text" id="name" name="name" class="form-control cyber-input"
                            value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>"
                            style="background: rgba(70, 60, 100, 0.9); border: 2px solid rgb(138, 74, 243); color: rgb(200, 200, 220); box-shadow: inset 0 0 10px rgba(138, 74, 243, 0.3); transition: all 0.3s ease;"
                            onfocus="this.style.boxShadow='inset 0 0 15px rgba(138, 74, 243, 0.7)'"
                            onblur="this.style.boxShadow='inset 0 0 10px rgba(138, 74, 243, 0.3)'" required>
                    </div>
                    <div class="col-md-6 form-group cyber-input-group">
                        <label for="price" class="cyber-label"
                            style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Giá
                            (VND):</label>
                        <input type="number" id="price" name="price" class="form-control cyber-input" step="0.01"
                            value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>"
                            style="background: rgba(70, 60, 100, 0.9); border: 2px solid rgb(138, 74, 243); color: rgb(200, 200, 220); box-shadow: inset 0 0 10px rgba(138, 74, 243, 0.3); transition: all 0.3s ease;"
                            onfocus="this.style.boxShadow='inset 0 0 15px rgba(138, 74, 243, 0.7)'"
                            onblur="this.style.boxShadow='inset 0 0 10px rgba(138, 74, 243, 0.3)'" required>
                    </div>
                    <div class="col-12 form-group cyber-input-group">
                        <label for="description" class="cyber-label"
                            style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Mô
                            tả:</label>
                        <textarea id="description" name="description" class="form-control cyber-input"
                            style="background: rgba(70, 60, 100, 0.9); border: 2px solid rgb(138, 74, 243); color: rgb(200, 200, 220); min-height: 150px; box-shadow: inset 0 0 10px rgba(138, 74, 243, 0.3); transition: all 0.3s ease;"
                            onfocus="this.style.boxShadow='inset 0 0 15px rgba(138, 74, 243, 0.7)'"
                            onblur="this.style.boxShadow='inset 0 0 10px rgba(138, 74, 243, 0.3)'"
                            required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>
                    <div class="col-md-6 form-group cyber-input-group">
                        <label for="category_id" class="cyber-label"
                            style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Danh
                            mục:</label>
                        <select id="category_id" name="category_id" class="form-control cyber-input"
                            style="background: rgba(70, 60, 100, 0.9); border: 2px solid rgb(138, 74, 243); color: rgb(200, 200, 220); box-shadow: inset 0 0 10px rgba(138, 74, 243, 0.3); transition: all 0.3s ease;"
                            onfocus="this.style.boxShadow='inset 0 0 15px rgba(138, 74, 243, 0.7)'"
                            onblur="this.style.boxShadow='inset 0 0 10px rgba(138, 74, 243, 0.3)'" required>
                            <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category->id; ?>"
                                <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>
                                style="color: rgb(200, 200, 220); background: rgb(40, 30, 60);">
                                <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group cyber-input-group">
                        <label for="image" class="cyber-label"
                            style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Hình
                            ảnh:</label>
                        <input type="file" id="image" name="image" class="form-control-file cyber-input"
                            style="color: rgb(200, 200, 220); border: 2px dashed rgb(138, 74, 243); padding: 10px; transition: all 0.3s ease;"
                            onfocus="this.style.borderColor='rgb(200, 170, 255)'"
                            onblur="this.style.borderColor='rgb(138, 74, 243)'">
                        <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">
                        <?php if ($product->image): ?>
                        <div class="mt-3 cyber-image-preview">
                            <img src="/<?php echo $product->image; ?>" alt="Product Image"
                                style="max-width: 150px; border: 2px solid rgb(138, 74, 243); border-radius: 8px; box-shadow: 0 0 10px rgba(138, 74, 243, 0.5);">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn cyber-btn cyber-btn-primary btn-lg px-5"
                        style="background: linear-gradient(135deg, rgb(107, 62, 168), rgb(138, 74, 243)); border: none; box-shadow: 0 0 15px rgba(138, 74, 243, 0.7); transition: all 0.3s ease;"
                        onmouseover="this.style.boxShadow='0 0 25px rgba(138, 74, 243, 1)'"
                        onmouseout="this.style.boxShadow='0 0 15px rgba(138, 74, 243, 0.7)'">
                        <i class="fas fa-save"></i> Lưu thay đổi
                    </button>
                    <a href="/webbanhang/Product/" class="btn cyber-btn cyber-btn-secondary btn-lg px-5 ms-3"
                        style="background: linear-gradient(135deg, rgb(90, 80, 120), rgb(60, 40, 90)); border: none; box-shadow: 0 0 15px rgba(90, 80, 120, 0.7); transition: all 0.3s ease;"
                        onmouseover="this.style.boxShadow='0 0 25px rgba(90, 80, 120, 1)'"
                        onmouseout="this.style.boxShadow='0 0 15px rgba(90, 80, 120, 0.7)'">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>