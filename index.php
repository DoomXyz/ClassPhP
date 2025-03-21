<?php
// Khởi tạo session
session_start();

// Require các file cần thiết
require_once 'app/helpers/SessionHelper.php';

// Lấy URL từ query string
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/'); // Xóa dấu / ở cuối
$url = filter_var($url, FILTER_SANITIZE_URL); // Làm sạch URL
$urlParts = explode('/', $url); // Chia URL thành các phần

// Xác định controller từ phần đầu tiên của URL
$controllerName = isset($urlParts[0]) && $urlParts[0] != '' ? ucfirst($urlParts[0]) . 'Controller' : 'ProductController';

// Xác định action từ phần thứ hai của URL
$action = isset($urlParts[1]) && $urlParts[1] != '' ? $urlParts[1] : 'index';

// Kiểm tra xem file controller có tồn tại không
$controllerFile = 'app/controllers/' . $controllerName . '.php';
if (!file_exists($controllerFile)) {
    // Nếu không tìm thấy controller, hiển thị trang lỗi 404
    header('HTTP/1.1 404 Not Found');
    include 'app/views/errors/404.php';
    exit();
}

// Require file controller
require_once $controllerFile;

// Khởi tạo controller
$controller = new $controllerName();

// Kiểm tra xem action có tồn tại trong controller không
if (!method_exists($controller, $action)) {
    // Nếu không tìm thấy action, hiển thị trang lỗi 404
    header('HTTP/1.1 404 Not Found');
    include 'app/views/errors/404.php';
    exit();
}

// Gọi action với các tham số còn lại (nếu có)
call_user_func_array([$controller, $action], array_slice($urlParts, 2));