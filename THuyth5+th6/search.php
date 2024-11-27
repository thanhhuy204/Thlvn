<?php
include 'connect.php';

$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : '';
// Kiểm tra xem người dùng đã đăng nhập chưa bằng cách kiểm tra biến phiên username.
// Lưu trữ tên người dùng nếu người dùng đã đăng nhập.

$query = isset($_GET['query']) ? $_GET['query'] : '';

// Escape special characters in the query to prevent SQL injection
$query = $conn->real_escape_string($query);

// Prepare SQL statement to search products
$sql = "SELECT * FROM products WHERE Name LIKE '%$query%' OR Category LIKE '%$query%' LIMIT 15";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="index.css"> <!-- Giữ nguyên CSS của trang -->
    <link rel="stylesheet" href="Header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet" />
</head>

<body>
<?php include 'header.php'; ?>
    <div id="wrapper">
        <div class="headline">
            <h3>Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($query); ?>"</h3>
        </div>
        <ul class="products">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="product-item">';
                    echo '<div class="product-top">';
                    echo '<img src="' . $row['Img'] . '" alt="' . htmlspecialchars($row['Name']) . '" class="img-responsive">';
                    echo '<a href="chitietsp.php?ID=' . $row['ID'] . '" class="buy-now">Mua ngay</a>';
                    echo '</div>';
                    echo '<div class="product-inform">';
                    echo '<a href="#" class="product-cat">' . htmlspecialchars($row['Category']) . '</a>';
                    echo '<a href="#" class="product-name">' . htmlspecialchars($row['Name']) . '</a>';
                    echo '<div class="product-price">' . number_format($row['Price'], 0, ',', '.') . ' VND</div>';
                    echo '</div>';
                    echo '</li>';
                }
            } else {
                echo '<li>Không có sản phẩm nào phù hợp với tìm kiếm của bạn.</li>';
            }
            ?>
        </ul>
    </div>
    
    <?php include 'footer.php'; ?>
</body>

</html>