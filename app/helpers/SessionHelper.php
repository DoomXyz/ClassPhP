<?php
// Đảm bảo file chỉ được bao gồm một lần
if (!defined('SESSION_HELPER_INCLUDED')) {
    define('SESSION_HELPER_INCLUDED', true);

    // Khởi động session nếu chưa được bắt đầu
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    class SessionHelper
    {
        /**
         * Kiểm tra xem người dùng đã đăng nhập hay chưa
         *
         * @return bool True nếu đã đăng nhập, false nếu chưa
         */
        public static function isLoggedIn(): bool
        {
            return isset($_SESSION['username']) && !empty(trim($_SESSION['username']));
        }

        /**
         * Kiểm tra xem người dùng có vai trò admin hay không
         *
         * @return bool True nếu là admin, false nếu không phải
         */
        public static function isAdmin(): bool
        {
            return self::isLoggedIn() && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
        }
    }
}