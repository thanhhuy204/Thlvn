<?php
session_start();
include 'connect.php';

//Lấy ID sản phẩm từ URL
$productId = isset($_GET['ID']) ? (int) $_GET['ID'] : 0;

if ($productId === 0) {
  die('ID sản phẩm không hợp lệ!');
}

$sql = "SELECT * FROM products WHERE ID = $productId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $product = $result->fetch_assoc();
} else {
  die('Sản phẩm không tồn tại.');
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link rel="stylesheet" href="Chitietsp.css">
    <script src="./icon/fontawesome/js/all.min.js"></script>
</head>

<body> 
    <div class="product-detail">
        <h1>Chi Tiết Sản Phẩm</h1>
        <div class="product-info">
            <div class="product-image">
                <img src="<?php echo $product['Img']; ?>" alt="Ảnh sản phẩm" id="productImage">
            </div>
            <div class="product-details">
                <h2><?php echo $product['Name']; ?></h2>
                <p>Giá: <?php echo $product['Price']; ?></p>
                <div class="product-description">
                    <h3>Giới thiệu sản phẩm</h3>
                    <p>Đây là áo đấu chính thức của Manchester United mùa giải 2023/2024. Sản phẩm được làm từ chất liệu cao
                        cấp, thấm hút mồ hôi tốt và mang lại cảm giác thoải mái cho người mặc.</p>
                </div>
                <div class="product-option">
                    <form action="add-to-cart.php" method="post"> 
                        <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $product['Name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $product['Price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $product['Img']; ?>">
                        <label for="size">Chọn size:</label>
                        <select name="size" id="size">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                        <label for="quantity">Số lượng:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1"><!--mac dinh la 1-->
                        <button type="submit"><i class="fa-solid fa-cart-shopping icon-cart"></i></button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</body>

</html>