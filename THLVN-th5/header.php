<?php
include 'connect.php';
session_start();

$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : '';
// Kiểm tra xem người dùng đã đăng nhập chưa bằng cách kiểm tra biến phiên username.
// Lưu trữ tên người dùng nếu người dùng đã đăng nhập.

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <div class="container">
        
        <div class="menu-up">
            <div class="img">
                <a href="">
                <img class="img" src="img/logo2.png" alt="">
                </a>
            </div>
            <div class="login-right">
            <div class="search">
                <form action="search.php" method="GET">
                        <input  type="text" name="query" placeholder="Tìm kiếm sản phẩm" aria-label="Tìm kiếm sản phẩm">
                        <button class="btn-search" type="submit" aria-label="Tìm kiếm"><i class="fa-solid fa-magnifying-glass icon-search"></i></button>
                </form>
            </div>
            <div class="up">
                <ul class="login">
                <li>
                    <?php if ($is_logged_in): ?>
                        <a href="">
                            <i class="fa-regular fa-user"></i> Xin chào, <?php echo htmlspecialchars($username); ?>
                        </a>
                        |
                        <a href="logout.php">Đăng xuất</a>
                    <?php else: ?>
                        <a href="login.php">
                            <i class="fa-regular fa-user"></i> Đăng nhập
                        </a>
                    <?php endif; ?>
                </li>
                    <li>
                        <a href="cart.php">
                            <i class="fa-solid fa-cart-shopping"></i> Giỏ hàng
                        </a>
                    </li>
                </ul>
            </div>
            </div>
            
        </div>
        <div class="menu-down">
            <ul id="main-menu">
                <li>
                    <a href="index.php">
                    <i class="fas fa-home"></i> Trang Chủ
                    </a>
                </li>
                <li>
                    <a href="sport.php">
                    <i class="fas fa-tshirt"></i> Đồ thể thao
                    </a>
                </li>
                <li>
                    <a href="phukien.php">
                    <i class="fas fa-futbol"></i> Phụ Kiện Thể Thao
                    </a>
                </li>
                <li>
                    <a href="">
                    <i class="fas fa-users"></i> Giới Thiệu
                    </a>
                </li>
                <li>
                    <a href="">
                    <i class="fas fa-tty"></i> Liên Hệ
                    </a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>