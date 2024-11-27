<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Xử lý cập nhật số lượng sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    foreach ($_POST['quantities'] as $productId => $quantity) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] = $quantity;
        }
    }
}

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['remove'])) {
    $productId = $_GET['remove'];
    unset($_SESSION['cart'][$productId]);
}

// Xử lý đặt hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order'])) {
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $_SESSION['cart'] = [];
    echo "<script>alert('Đặt hàng thành công!');</script>";
}   
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="cart.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="cart-container">
        <h1>Giỏ Hàng</h1>
        <form method="post" action="cart.php">
            <table>
                <thead>
                    <tr>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $productId => $product): ?>
                    <tr>
                        <td><img src="<?php echo $product['product_image']; ?>"
                                alt="<?php echo $product['product_name']; ?>"></td>
                        <td><?php echo $product['product_name']; ?></td>
                        <td><?php echo number_format($product['product_price']); ?> đ</td>
                        <td><?php echo $product['size']; ?></td>
                        <td>
                            <input type="number" name="quantities[<?php echo $productId; ?>]"
                                value="<?php echo $product['quantity']; ?>" min="1">
                        </td>
                        <td><?php echo number_format($product['product_price'] * $product['quantity']); ?> đ</td>
                        <td>
                            <a href="cart.php?remove=<?php echo $productId; ?>" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="update" class="btn btn-primary">Cập nhật giỏ hàng</button>
            <a href="index.php">Quay lại trang chủ </a>
        </form>
        <div class="cart-total">
            <h3>Tổng cộng:
                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $product) {
                    $total += $product['product_price'] * $product['quantity'];
                }
                echo number_format($total); 
                ?>
            </h3>
        </div>
        <form method="post" action="cart.php" class="order-form">
            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <button type="submit" name="order" class="btn btn-success">Đặt hàng</button>
        </form>
    </div>
</body>

</html>