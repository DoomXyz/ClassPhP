<?php include 'app/views/shares/header.php'; ?>
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-4 text-center" style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif;">Danh
                sách thể loại</h1>
            <div class="text-center mb-3">
                <a href="/webbanhang/Category/add" class="btn btn-success btn-lg shadow-sm"><i class="fas fa-plus"></i>
                    Thêm thể loại mới</a>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($categories as $category): ?>
        <div class="col">
            <div class="card h-100 shadow-sm"
                style="background: linear-gradient(135deg, rgb(40, 30, 60) 0%, rgb(60, 40, 90) 100%); border: 2px solid rgb(138, 74, 243);">
                <div class="card-body">
                    <h5 class="card-title" style="color: rgb(200, 170, 255);">
                        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                    </h5>
                    <p class="card-text" style="color: rgb(180, 180, 200); min-height: 60px;">
                        <?php echo htmlspecialchars($category->description ?? 'Không có mô tả', ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <div class="btn-group w-100">
                        <a href="/webbanhang/Category/edit/<?php echo $category->id; ?>"
                            class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</a>
                        <a href="/webbanhang/Category/delete/<?php echo $category->id; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa thể loại này?');"><i
                                class="fas fa-trash"></i> Xóa</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>