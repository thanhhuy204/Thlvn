<?php
session_start(); // Bắt đầu phiên làm việc

$host = "localhost";
$username = "root";
$password = "";
$database = "shop";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rpassword = $_POST['rpassword'];

    if ($password !== $rpassword) {
        echo "Mật khẩu không khớp. Vui lòng thử lại.";
        exit();
    }

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM `register` WHERE `username` = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Tên người dùng đã tồn tại. Vui lòng sử dụng một tên khác.";
    } else {
        $sql = "INSERT INTO `register` (`username`, `email`, `password`) VALUES ('$username', '$email', '$hashed_password')";
        $sql1 = "INSERT INTO `login` (`username`, `password`) VALUES ('$username', '$hashed_password')";

        if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
            echo "<script>alert('Đăng ký thành công!.')</script>";
        } else {
            echo "<script>alert('Lỗi.')</script>: " . $conn->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = " SELECT * FROM `login` WHERE `username` = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Lưu trữ tên người dùng trong phiên làm việc
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Sai mật khẩu')</script>";
        }
    } else {
        echo "<script>alert('Đăng nhập thất bại.')</script>";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/img/logo/main-logo-2.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="Login.css">
    <title>Login</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="">
                <h1>Đăng ký</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>  
                <input type="text" placeholder="Tên" name="username" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Mật khẩu" name="password" required>
                <input type="password" placeholder="Nhập lại mật khẩu" name="rpassword" required>
                <button type="submit" name="register">Đăng ký</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action="">
                <h1>Đăng nhập</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <input type="text" placeholder="Tên người dùng" name="username" required>
                <input type="password" placeholder="Mật khẩu" name="password" required>
                <a href="#">Quên mật khẩu?</a>
                <button type="submit" name="login">Đăng nhập</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Chào mừng!</h1>
                    <p>Nhập đầy đủ thông tin của bạn để đăng kí tài khoản!</p>
                    <button class="hidden" id="login">Đăng nhập</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Xin chào!</h1>
                    <p>Bạn có thể đăng ký tài khoản tại đây!</p>
                    <button class="hidden" id="register">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
