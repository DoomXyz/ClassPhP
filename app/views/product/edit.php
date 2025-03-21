<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h1 class="display-4 text-center mb-4" style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif;">
                Sửa sản phẩm
            </h1>

            <!-- Error Messages -->
            <?php if (!empty($errors)): ?>
            <div class="alert alert-danger shadow-sm"
                style="background: rgb(60, 20, 40); border-color: rgb(220, 53, 69); color: rgb(255, 200, 200);">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                    <li>
                        <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Form -->
            <form method="POST" action="/webbanhang/Product/update" enctype="multipart/form-data"
                onsubmit="return validateForm();" class="p-4 rounded shadow-sm"
                style="background: linear-gradient(135deg, rgb(40, 30, 60) 0%, rgb(60, 40, 90) 100%);">
                <input type="hidden" name="id" value="<?php echo $product->id; ?>">

                <div class="form-group">
                    <label for="name" style="color: rgb(200, 170, 255);">Tên sản phẩm:</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>"
                        style="background: rgb(70, 60, 100); border-color: rgb(138, 74, 243); color: rgb(200, 200, 220);"
                        required>
                </div>

                <div class="form-group">
                    <label for="description" style="color: rgb(200, 170, 255);">Mô tả:</label>
                    <textarea id="description" name="description" class="form-control"
                        style="background: rgb(70, 60, 100); border-color: rgb(138, 74, 243); color: rgb(200, 200, 220); min-height: 120px;"
                        required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="price" style="color: rgb(200, 170, 255);">Giá:</label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01"
                        value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>"
                        style="background: rgb(70, 60, 100); border-color: rgb(138, 74, 243); color: rgb(200, 200, 220);"
                        required>
                </div>

                <div class="form-group">
                    <label for="category_id" style="color: rgb(200, 170, 255);">Danh mục:</label>
                    <select id="category_id" name="category_id" class="form-control"
                        style="background: rgb(70, 60, 100); border-color: rgb(138, 74, 243); color: rgb(200, 200, 220);"
                        required>
                        <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->id; ?>"
                            <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>
                            style="color: rgb(20, 20, 30);">
                            <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image" style="color: rgb(200, 170, 255);">Hình ảnh:</label>
                    <input type="file" id="image" name="image" class="form-control-file"
                        style="color: rgb(200, 200, 220);">
                    <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">
                    <?php if ($product->image): ?>
                    <div class="mt-2">
                        <img src="/<?php echo $product->image; ?>" alt="Product Image" class="img-thumbnail"
                            style="max-width: 150px; border: 2px solid rgb(138, 74, 243);">
                    </div>
                    <?php endif; ?>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg px-4"
                        style="background-color: rgb(107, 62, 168); border-color: rgb(107, 62, 168);">
                        <i class="fas fa-save"></i> Lưu thay đổi
                    </button>
                    <a href="/webbanhang/Product/" class="btn btn-secondary btn-lg px-4 mt-2 mt-md-0 ml-md-2"
                        style="background-color: rgb(90, 80, 120); border-color: rgb(90, 80, 120);">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách sản phẩm
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>