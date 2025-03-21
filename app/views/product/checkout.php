<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5 cyber-container" style="position: relative; overflow: hidden;">
    <div class="cyber-overlay"
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(45deg, rgba(40, 30, 60, 0.8), rgba(138, 74, 243, 0.2)); z-index: 1; pointer-events: none;">
    </div>
    <h1 class="display-3 text-center mb-5 cyber-title"
        style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif; text-shadow: 0 0 10px rgb(138, 74, 243); animation: glow 2s infinite alternate; position: relative; z-index: 2;">
        Thanh toán
    </h1>

    <form method="POST" action="/webbanhang/Product/processCheckout" class="p-5 rounded cyber-form"
        style="background: linear-gradient(135deg, rgb(40, 30, 60), rgb(60, 40, 90)); border: 3px solid rgb(138, 74, 243); box-shadow: 0 0 20px rgba(138, 74, 243, 0.5); position: relative; z-index: 2;">
        <div class="row g-4">
            <div class="col-md-6 form-group cyber-input-group">
                <label for="name" class="cyber-label"
                    style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Họ tên:</label>
                <input type="text" id="name" name="name" class="form-control cyber-input"
                    style="background: rgba(70, 60, 100, 0.9); border: 2px solid rgb(138, 74, 243); color: rgb(200, 200, 220); box-shadow: inset 0 0 10px rgba(138, 74, 243, 0.3); transition: all 0.3s ease;"
                    onfocus="this.style.boxShadow='inset 0 0 15px rgba(138, 74, 243, 0.7)'"
                    onblur="this.style.boxShadow='inset 0 0 10px rgba(138, 74, 243, 0.3)'" required>
            </div>
            <div class="col-md-6 form-group cyber-input-group">
                <label for="phone" class="cyber-label"
                    style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Số điện
                    thoại:</label>
                <input type="text" id="phone" name="phone" class="form-control cyber-input"
                    style="background: rgba(70, 60, 100, 0.9); border: 2px solid rgb(138, 74, 243); color: rgb(200, 200, 220); box-shadow: inset 0 0 10px rgba(138, 74, 243, 0.3); transition: all 0.3s ease;"
                    onfocus="this.style.boxShadow='inset 0 0 15px rgba(138, 74, 243, 0.7)'"
                    onblur="this.style.boxShadow='inset 0 0 10px rgba(138, 74, 243, 0.3)'" required>
            </div>
            <div class="col-12 form-group cyber-input-group">
                <label for="address" class="cyber-label"
                    style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Địa chỉ:</label>
                <textarea id="address" name="address" class="form-control cyber-input"
                    style="background: rgba(70, 60, 100, 0.9); border: 2px solid rgb(138, 74, 243); color: rgb(200, 200, 220); min-height: 150px; box-shadow: inset 0 0 10px rgba(138, 74, 243, 0.3); transition: all 0.3s ease;"
                    onfocus="this.style.boxShadow='inset 0 0 15px rgba(138, 74, 243, 0.7)'"
                    onblur="this.style.boxShadow='inset 0 0 10px rgba(138, 74, 243, 0.3)'" required></textarea>
            </div>
        </div>
        <div class="text-center mt-5">
            <button type="submit" class="btn cyber-btn cyber-btn-primary btn-lg px-5"
                style="background: linear-gradient(135deg, rgb(107, 62, 168), rgb(138, 74, 243)); border: none; box-shadow: 0 0 15px rgba(138, 74, 243, 0.7); transition: all 0.3s ease;"
                onmouseover="this.style.boxShadow='0 0 25px rgba(138, 74, 243, 1)'"
                onmouseout="this.style.boxShadow='0 0 15px rgba(138, 74, 243, 0.7)'">
                Thanh toán
            </button>
            <a href="/webbanhang/Product/cart" class="btn cyber-btn cyber-btn-secondary btn-lg px-5 ms-3 mt-3"
                style="background: linear-gradient(135deg, rgb(90, 80, 120), rgb(60, 40, 90)); border: none; box-shadow: 0 0 15px rgba(90, 80, 120, 0.7); transition: all 0.3s ease;"
                onmouseover="this.style.boxShadow='0 0 25px rgba(90, 80, 120, 1)'"
                onmouseout="this.style.boxShadow='0 0 15px rgba(90, 80, 120, 0.7)'">
                Quay lại giỏ hàng
            </a>
        </div>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>