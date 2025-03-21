<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    /* Base Styles */
    body {
        background: rgb(20, 20, 30);
        color: rgb(220, 210, 255);
        font-family: 'Arial', sans-serif;
        line-height: 1.6;
    }

    /* Navbar Customization */
    .navbar {
        background: linear-gradient(135deg, rgb(40, 30, 60) 0%, rgb(60, 40, 90) 100%);
        border-bottom: 2px solid rgb(107, 62, 168);
        padding: 1rem;
    }

    .navbar.fixed-top {
        z-index: 1030;
        /* Đảm bảo navbar luôn ở trên cùng */
    }

    .navbar-brand,
    .nav-link {
        color: rgb(220, 210, 255) !important;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: rgb(170, 102, 204) !important;
    }

    .navbar-brand i {
        color: rgb(138, 74, 243);
        margin-right: 8px;
    }

    .nav-link i {
        margin-right: 6px;
        color: rgb(107, 62, 168);
    }

    .navbar-toggler {
        border-color: rgb(107, 62, 168);
    }

    /* Form and Input Styles */
    .form-control {
        background: rgb(40, 30, 60);
        border-color: rgb(80, 70, 110);
        color: rgb(220, 210, 255);
    }

    .form-control:focus {
        background: rgb(50, 40, 70);
        border-color: rgb(138, 74, 243);
        color: rgb(220, 210, 255);
        box-shadow: 0 0 8px rgba(138, 74, 243, 0.5);
    }

    /* Button Styles */
    .btn-primary {
        background: rgb(107, 62, 168);
        border-color: rgb(107, 62, 168);
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: rgb(138, 74, 243);
        border-color: rgb(138, 74, 243);
        box-shadow: 0 4px 12px rgba(138, 74, 243, 0.3);
    }

    /* Card Styles */
    .card {
        background: linear-gradient(135deg, rgb(40, 30, 60) 0%, rgb(60, 40, 90) 100%);
        border: 1px solid rgb(80, 70, 110);
        border-radius: 8px;
        padding: 15px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(138, 74, 243, 0.4);
        transition: all 0.3s ease;
    }

    .card i {
        color: rgb(138, 74, 243);
        margin-right: 10px;
    }

    /* Container */
    .container {
        padding: 20px;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="/webbanhang/Product/">
            <i class="fas fa-bug"></i> Quản lý sản phẩm
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/">
                        <i class="fas fa-list-ul"></i> Danh sách sản phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/add">
                        <i class="fas fa-plus-circle"></i> Thêm sản phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Category">
                        <i class="fas fa-tags"></i> Chỉnh sửa thể loại
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/cart">
                        <i class="fas fa-shopping-cart"></i> Giỏ hàng
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Khoảng cách để nội dung không bị che bởi header cố định -->
    <div style="padding-top: 70px;"></div>