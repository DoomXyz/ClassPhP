<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5 cyber-container" style="position: relative; overflow: hidden;">
    <div class="cyber-overlay"
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(45deg, rgba(40, 30, 60, 0.8), rgba(138, 74, 243, 0.2)); z-index: 1; pointer-events: none;">
    </div>
    <div class="text-center position-relative" style="z-index: 2;">
        <h1 class="display-3 cyber-title mb-4"
            style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif; text-shadow: 0 0 10px rgb(138, 74, 243); animation: glow 2s infinite alternate;">
            Xác nhận đơn hàng
        </h1>
        <p class="fs-4 cyber-text"
            style="color: rgb(200, 170, 255); text-shadow: 0 0 5px rgba(200, 170, 255, 0.5); animation: fadeIn 1s ease-out;">
            Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được xử lý thành công.
        </p>
        <a href="/webbanhang/Product" class="btn cyber-btn cyber-btn-primary btn-lg px-5 mt-4"
            style="background: linear-gradient(135deg, rgb(107, 62, 168), rgb(138, 74, 243)); border: none; box-shadow: 0 0 15px rgba(138, 74, 243, 0.7); transition: all 0.3s ease;"
            onmouseover="this.style.boxShadow='0 0 25px rgba(138, 74, 243, 1)'"
            onmouseout="this.style.boxShadow='0 0 15px rgba(138, 74, 243, 0.7)'">
            Tiếp tục mua sắm
        </a>
    </div>
</div>

<style>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<?php include 'app/views/shares/footer.php'; ?>