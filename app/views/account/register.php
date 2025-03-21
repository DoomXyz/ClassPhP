<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5 cyber-container" style="position: relative; overflow: hidden;">
    <div class="cyber-overlay"
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(45deg, rgba(40, 30, 60, 0.8), rgba(138, 74, 243, 0.2)); z-index: 1; pointer-events: none;">
    </div>
    <div class="row justify-content-center position-relative" style="z-index: 2;">
        <div class="col-12 col-lg-10">
            <h1 class="display-3 text-center mb-5 cyber-title"
                style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif; text-shadow: 0 0 10px rgb(138, 74, 243); animation: glow 2s infinite alternate;">
                Đăng ký tài khoản
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
            <form class="p-5 rounded cyber-form" action="/webbanhang/account/save" method="post"
                onsubmit="return validateForm()"
                style="background: linear-gradient(135deg, rgb(40, 30, 60), rgb(60, 40, 90)); border: 3px solid rgb(138, 74, 243); box-shadow: 0 0 20px rgba(138, 74, 243, 0.5);">
                <div class="row g-4">
                    <div class="col-sm-6 form-group cyber-input-group">
                        <label for="account" class="cyber-label"
                            style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Tài
                            khoản:</label>
                        <input type="text" class="form-control cyber-input" id="account" name="account"
                            placeholder="Account (Tài khoản)"
                            value="<?php echo isset($_POST['account']) ? htmlspecialchars($_POST['account']) : ''; ?>"
                            required
                            style="background: rgba(70, 60, 100, 0.9); border: 2px solid rgb(138, 74, 243); color: rgb(200, 200, 220); box-shadow: inset 0 0 10px rgba(138, 74, 243, 0.3); transition: all 0.3s ease;"
                            onfocus="this.style.boxShadow='inset 0 0 15px rgba(138, 74, 243, 0.7)'"
                            onblur="this.style.boxShadow='inset 0 0 10px rgba(138, 74, 243, 0.3)'">
                        <?php if (isset($errors['account'])): ?>
                        <small class="text-danger d-block mt-2 cyber-text"
                            style="text-shadow: 0 0 5px rgba(255, 200, 200, 0.5);">
                            <?php echo htmlspecialchars($errors['account'], ENT_QUOTES, 'UTF-8'); ?>
                        </small>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6 form-group cyber-input-group">
                        <label for="username" class="cyber-label"
                            style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Tên hiển
                            thị:</label>
                        <input type="text" class="form-control cyber-input" id="username" name="username"
                            placeholder="Username (Tên hiển thị)"
                            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                            required
                            style="background: rgba(70, 60, 100, 0.9); border: 2px solid rgb(138, 74, 243); color: rgb(200, 200, 220); box-shadow: inset 0 0 10px rgba(138, 74, 243, 0.3); transition: all 0.3s ease;"
                            onfocus="this.style.boxShadow='inset 0 0 15px rgba(138, 74, 243, 0.7)'"
                            onblur="this.style.boxShadow='inset 0 0 10px rgba(138, 74, 243, 0.3)'">
                        <?php if (isset($errors['username'])): ?>
                        <small class="text-danger d-block mt-2 cyber-text"
                            style="text-shadow: 0 0 5px rgba(255, 200, 200, 0.5);">
                            <?php echo htmlspecialchars($errors['username'], ENT_QUOTES, 'UTF-8'); ?>
                        </small>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6 form-group cyber-input-group">
                        <label for="password" class="cyber-label"
                            style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Mật
                            khẩu:</label>
                        <input type="password" class="form-control cyber-input" id="password" name="password"
                            placeholder="Password" required minlength="8"
                            pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                            title="Mật khẩu phải có ít nhất 8 ký tự, chứa cả chữ cái và số"
                            style="background: rgba(70, 60, 100, 0.9); border: 2px solid rgb(138, 74, 243); color: rgb(200, 200, 220); box-shadow: inset 0 0 10px rgba(138, 74, 243, 0.3); transition: all 0.3s ease;"
                            onfocus="this.style.boxShadow='inset 0 0 15px rgba(138, 74, 243, 0.7)'"
                            onblur="this.style.boxShadow='inset 0 0 10px rgba(138, 74, 243, 0.3)'">
                        <?php if (isset($errors['password'])): ?>
                        <small class="text-danger d-block mt-2 cyber-text"
                            style="text-shadow: 0 0 5px rgba(255, 200, 200, 0.5);">
                            <?php echo htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8'); ?>
                        </small>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6 form-group cyber-input-group">
                        <label for="confirmpassword" class="cyber-label"
                            style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Xác nhận
                            mật khẩu:</label>
                        <input type="password" class="form-control cyber-input" id="confirmpassword"
                            name="confirmpassword" placeholder="Confirm Password" required
                            style="background: rgba(70, 60, 100, 0.9); border: 2px solid rgb(138, 74, 243); color: rgb(200, 200, 220); box-shadow: inset 0 0 10px rgba(138, 74, 243, 0.3); transition: all 0.3s ease;"
                            onfocus="this.style.boxShadow='inset 0 0 15px rgba(138, 74, 243, 0.7)'"
                            onblur="this.style.boxShadow='inset 0 0 10px rgba(138, 74, 243, 0.3)'">
                        <?php if (isset($errors['confirmPass'])): ?>
                        <small class="text-danger d-block mt-2 cyber-text"
                            style="text-shadow: 0 0 5px rgba(255, 200, 200, 0.5);">
                            <?php echo htmlspecialchars($errors['confirmPass'], ENT_QUOTES, 'UTF-8'); ?>
                        </small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn cyber-btn cyber-btn-primary btn-lg px-5"
                        style="background: linear-gradient(135deg, rgb(107, 62, 168), rgb(138, 74, 243)); border: none; box-shadow: 0 0 15px rgba(138, 74, 243, 0.7); transition: all 0.3s ease;"
                        onmouseover="this.style.boxShadow='0 0 25px rgba(138, 74, 243, 1)'"
                        onmouseout="this.style.boxShadow='0 0 15px rgba(138, 74, 243, 0.7)'">
                        <i class="fas fa-user-plus"></i> Đăng ký
                    </button>
                    <a href="/webbanhang/account/login" class="btn cyber-btn cyber-btn-secondary btn-lg px-5 ms-3"
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

<script>
function validateForm() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmpassword").value;
    if (password !== confirmPassword) {
        alert("Mật khẩu và xác nhận mật khẩu không khớp!");
        return false;
    }
    return true;
}
</script>

<?php include 'app/views/shares/footer.php'; ?>