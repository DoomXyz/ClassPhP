<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h1 class="display-4 text-center mb-4" style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif;">
                Thêm thể loại mới
            </h1>

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

            <form method="POST" action="/webbanhang/Category/save" class="p-4 rounded shadow-sm"
                style="background: linear-gradient(135deg, rgb(40, 30, 60) 0%, rgb(60, 40, 90) 100%);">
                <div class="form-group">
                    <label for="name" style="color: rgb(200, 170, 255);">Tên thể loại:</label>
                    <input type="text" id="name" name="name" class="form-control"
                        style="background: rgb(70, 60, 100); border-color: rgb(138, 74, 243); color: rgb(200, 200, 220);"
                        required>
                </div>
                <div class="form-group">
                    <label for="description" style="color: rgb(200, 170, 255);">Mô tả:</label>
                    <textarea id="description" name="description" class="form-control"
                        style="background: rgb(70, 60, 100); border-color: rgb(138, 74, 243); color: rgb(200, 200, 220); min-height: 120px;"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg px-4"
                        style="background-color: rgb(107, 62, 168); border-color: rgb(107, 62, 168);">
                        <i class="fas fa-plus"></i> Thêm thể loại
                    </button>
                    <a href="/webbanhang/Category" class="btn btn-secondary btn-lg px-4 mt-2 mt-md-0 ml-md-2"
                        style="background-color: rgb(90, 80, 120); border-color: rgb(90, 80, 120);">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>