<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5 cyber-container" style="position: relative; overflow: hidden;">
    <div class="cyber-overlay"
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(45deg, rgba(40, 30, 60, 0.8), rgba(138, 74, 243, 0.2)); z-index: 1; pointer-events: none;">
    </div>
    <div class="row mb-4 position-relative" style="z-index: 2;">
        <div class="col-12">
            <h1 class="display-4 text-center cyber-title"
                style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif; text-shadow: 0 0 10px rgb(138, 74, 243); animation: glow 2s infinite alternate;">
                Danh sách thể loại
            </h1>
            <div class="text-center mb-3">
                <a href="/webbanhang/Category/add" class="btn cyber-btn cyber-btn-primary btn-lg px-4"
                    style="background: linear-gradient(135deg, rgb(107, 62, 168), rgb(138, 74, 243)); border: none; box-shadow: 0 0 15px rgba(138, 74, 243, 0.7); transition: all 0.3s ease;"
                    onmouseover="this.style.boxShadow='0 0 25px rgba(138, 74, 243, 1)'"
                    onmouseout="this.style.boxShadow='0 0 15px rgba(138, 74, 243, 0.7)'">
                    <i class="fas fa-plus"></i> Thêm thể loại mới
                </a>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 position-relative" style="z-index: 2;">
        <?php foreach ($categories as $category): ?>
        <div class="col">
            <div class="card h-100 cyber-form"
                style="background: linear-gradient(135deg, rgb(40, 30, 60), rgb(60, 40, 90)); border: 2px solid rgb(138, 74, 243); box-shadow: 0 0 20px rgba(138, 74, 243, 0.5);">
                <div class="card-body">
                    <h5 class="card-title cyber-label"
                        style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">
                        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                    </h5>
                    <p class="card-text cyber-text"
                        style="color: rgb(180, 180, 200); min-height: 60px; text-shadow: 0 0 5px rgba(180, 180, 200, 0.5);">
                        <?php echo htmlspecialchars($category->description ?? 'Không có mô tả', ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <div class="btn-group w-100">
                        <a href="/webbanhang/Category/edit/<?php echo $category->id; ?>"
                            class="btn cyber-btn cyber-btn-primary btn-sm"
                            style="background: linear-gradient(135deg, rgb(107, 62, 168), rgb(138, 74, 243)); border: none; box-shadow: 0 0 15px rgba(138, 74, 243, 0.7); transition: all 0.3s ease;"
                            onmouseover="this.style.boxShadow='0 0 25px rgba(138, 74, 243, 1)'"
                            onmouseout="this.style.boxShadow='0 0 15px rgba(138, 74, 243, 0.7)'">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <a href="/webbanhang/Category/delete/<?php echo $category->id; ?>"
                            class="btn cyber-btn cyber-btn-secondary btn-sm"
                            style="background: linear-gradient(135deg, rgb(90, 80, 120), rgb(60, 40, 90)); border: none; box-shadow: 0 0 15px rgba(90, 80, 120, 0.7); transition: all 0.3s ease;"
                            onmouseover="this.style.boxShadow='0 0 25px rgba(90, 80, 120, 1)'"
                            onmouseout="this.style.boxShadow='0 0 15px rgba(90, 80, 120, 0.7)'"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa thể loại này?');">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
@keyframes glow {
    0% {
        text-shadow: 0 0 10px rgb(138, 74, 243);
    }

    100% {
        text-shadow: 0 0 20px rgb(138, 74, 243), 0 0 30px rgb(200, 170, 255);
    }
}

@keyframes slideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }

    to {
        transform: translateY(-10px);
        opacity: 1;
    }
}
</style>

<?php include 'app/views/shares/footer.php'; ?>