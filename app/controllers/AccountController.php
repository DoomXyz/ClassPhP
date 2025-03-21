<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController
{
    private $accountModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        if (!$this->db) {
            die("Kết nối cơ sở dữ liệu thất bại!");
        }
        $this->accountModel = new AccountModel($this->db);
    }

    function register()
    {
        include_once 'app/views/account/register.php';
    }

    public function login()
    {
        include_once 'app/views/account/login.php';
    }

    function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account = trim($_POST['account'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';

            $errors = [];

            // Kiểm tra tài khoản
            if (empty($account)) {
                $errors['account'] = "Vui lòng nhập tài khoản!";
            } elseif (strlen($account) < 4) {
                $errors['account'] = "Tài khoản phải có ít nhất 4 ký tự!";
            }

            // Kiểm tra tên hiển thị
            if (empty($username)) {
                $errors['username'] = "Vui lòng nhập tên hiển thị!";
            } elseif (strlen($username) < 2) {
                $errors['username'] = "Tên hiển thị phải có ít nhất 2 ký tự!";
            }

            // Kiểm tra mật khẩu
            if (empty($password)) {
                $errors['password'] = "Vui lòng nhập mật khẩu!";
            } elseif (strlen($password) < 8) {
                $errors['password'] = "Mật khẩu phải có ít nhất 8 ký tự!";
            } elseif (!preg_match("/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/", $password)) {
                $errors['password'] = "Mật khẩu phải chứa cả chữ cái và số!";
            }

            if ($password !== $confirmPassword) {
                $errors['confirmPass'] = "Mật khẩu và xác nhận không khớp!";
            }

            // Kiểm tra tài khoản đã tồn tại
            $existingAccount = $this->accountModel->getAccountByAccount($account);
            if ($existingAccount) {
                $errors['account'] = "Tài khoản này đã được đăng ký!";
            }

            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $result = $this->accountModel->save($account, $username, $password);

                if ($result) {
                    // Lấy ID của user vừa tạo
                    $user = $this->accountModel->getAccountByAccount($account);
                    session_start();
                    $_SESSION['user_id'] = $user->id; // Lưu user_id
                    $_SESSION['username'] = $username; // Lưu username
                    header('Location: /webbanhang/account/login?success=Đăng ký thành công!');
                    exit;
                } else {
                    $errors['general'] = "Đã xảy ra lỗi khi lưu tài khoản. Vui lòng thử lại!";
                    include_once 'app/views/account/register.php';
                }
            }
        }
    }

    function logout()
    {
        session_start();
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        header('Location: /webbanhang/product');
        exit;
    }

    public function checkLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account = trim($_POST['account'] ?? '');
            $password = $_POST['password'] ?? '';

            $errors = [];

            if (empty($account)) {
                $errors['account'] = "Vui lòng nhập tài khoản!";
            }
            if (empty($password)) {
                $errors['password'] = "Vui lòng nhập mật khẩu!";
            }

            if (empty($errors)) {
                $accountData = $this->accountModel->getAccountByAccount($account);
                if ($accountData) {
                    $pwd_hashed = $accountData->password;
                    if (password_verify($password, $pwd_hashed)) {
                        session_start();
                        $_SESSION['user_id'] = $accountData->id; // Lưu user_id
                        $_SESSION['username'] = $accountData->username;
                        header('Location: /webbanhang/product');
                        exit;
                    } else {
                        $errors['password'] = "Mật khẩu không đúng!";
                    }
                } else {
                    $errors['account'] = "Không tìm thấy tài khoản!";
                }
            }

            // Nếu có lỗi, hiển thị lại form login với thông báo lỗi
            include_once 'app/views/account/login.php';
        } else {
            // Nếu không phải POST, hiển thị form login
            include_once 'app/views/account/login.php';
        }
    }

    // Thêm phương thức để hiển thị profile
    public function profile()
    {
        // Kiểm tra xem user đã đăng nhập chưa
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit();
        }

        // Lấy thông tin user từ session
        $userId = $_SESSION['user_id'];
        $user = $this->accountModel->getAccountById($userId);

        if (!$user) {
            echo "Không tìm thấy thông tin người dùng.";
            exit();
        }

        // Load view và truyền dữ liệu user
        include_once 'app/views/account/profile.php';
    }
}