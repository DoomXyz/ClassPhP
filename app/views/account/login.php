<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5 cyber-container" style="position: relative; overflow: hidden;">
    <div class="cyber-overlay"
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(45deg, rgba(40, 30, 60, 0.8), rgba(138, 74, 243, 0.2)); z-index: 1; pointer-events: none;">
    </div>
    <div class="row justify-content-center position-relative" style="z-index: 2;">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white cyber-form"
                style="border-radius: 1rem; background: linear-gradient(135deg, rgb(40, 30, 60), rgb(60, 40, 90)); border: 3px solid rgb(138, 74, 243); box-shadow: 0 0 20px rgba(138, 74, 243, 0.5);">
                <div class="card-body p-5 text-center">
                    <h2 class="fw-bold mb-2 text-uppercase cyber-title"
                        style="color: rgb(170, 102, 204); font-family: 'Arial', sans-serif; text-shadow: 0 0 10px rgb(138, 74, 243); animation: glow 2s infinite alternate;">
                        Đăng nhập
                    </h2>
                    <p class="text-white-50 mb-5">Vui lòng nhập tài khoản và mật khẩu của bạn!</p>

                    <!-- Success Message -->
                    <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success shadow-lg cyber-alert"
                        style="background: linear-gradient(135deg, rgb(20, 60, 40), rgb(30, 80, 50)); border: 2px solid rgb(40, 167, 69); color: rgb(200, 255, 200); transform: translateY(-10px); animation: slideIn 0.5s ease-out;">
                        <p class="mb-0 cyber-text" style="text-shadow: 0 0 5px rgba(200, 255, 200, 0.5);">
                            <?php echo htmlspecialchars($_GET['success'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                    </div>
                    <?php endif; ?>

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

                    <form action="/webbanhang/account/checkLogin" method="post">
                        <div class="form-outline form-white mb-4 cyber-input-group">
                            <label for="account" class="cyber-label"
                                style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Tài
                                khoản:</label>
                            <input type="text" name="account" id="account"
                                class="form-control form-control-lg cyber-input"
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

                        <div class="form-outline form-white mb-4 cyber-input-group">
                            <label for="password" class="cyber-label"
                                style="color: rgb(200, 170, 255); text-transform: uppercase; letter-spacing: 1px;">Mật
                                khẩu:</label>
                            <input type="password" name="password" id="password"
                                class="form-control form-control-lg cyber-input" required
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

                        <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Quên mật khẩu?</a></p>

                        <button class="btn cyber-btn cyber-btn-primary btn-lg px-5"
                            style="background: linear-gradient(135deg, rgb(107, 62, 168), rgb(138, 74, 243)); border: none; box-shadow: 0 0 15px rgba(138, 74, 243, 0.7); transition: all 0.3s ease;"
                            onmouseover="this.style.boxShadow='0 0 25px rgba(138, 74, 243, 1)'"
                            onmouseout="this.style.boxShadow='0 0 15px rgba(138, 74, 243, 0.7)'">
                            <i class="fas fa-sign-in-alt"></i> Đăng nhập
                        </button>

                        <div class="d-flex justify-content-center text-center mt-4 pt-1">
                            <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                            <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                            <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                        </div>

                        <div class="mt-4">
                            <p class="mb-0">Chưa có tài khoản? <a href="/webbanhang/account/register"
                                    class="text-white-50 fw-bold">Đăng ký</a></p>
                        </div>
                    </form>
                </div>
            </div>
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

<?php include 'app/views/shares/footer.php'; ?>