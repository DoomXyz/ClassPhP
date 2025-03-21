<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card p-4">
                <h1 class="text-center mb-4"
                    style="color: rgb(170, 102, 204); text-shadow: 0 0 10px rgb(138, 74, 243);">
                    Hồ sơ người dùng
                </h1>

                <div class="mb-4">
                    <label style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">
                        Tên tài khoản:
                    </label>
                    <p style="color: rgb(220, 210, 255);">
                        <?php echo htmlspecialchars($user->account, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                </div>
                <div class="mb-4">
                    <label style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">
                        Tên hiển thị:
                    </label>
                    <p style="color: rgb(220, 210, 255);">
                        <?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                </div>
                <div class="text-center">
                    <a href="/webbanhang/product" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>