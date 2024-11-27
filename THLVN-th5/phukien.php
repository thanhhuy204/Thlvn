<?php include 'header.php'; ?>
<?php include 'connect.php';?>
<?php
$limit=10;
// Trang hiện tại, mặc định là 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Tìm Start
$start = ($current_page - 1) * $limit;

// Tìm tổng số sản phẩm thuộc danh mục 'sports'
$sql_total = "SELECT COUNT(ID) as total FROM products WHERE Category='accessories'";
$result_total = $conn->query($sql_total);
$total_records = $result_total->fetch_assoc()['total'];

// Tổng số trang
$total_page = ceil($total_records / $limit);

// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}
// Truy vấn sản phẩm thuộc danh mục 'sports'
$sql = "SELECT * FROM products WHERE Category='accessories'LIMIT $start, $limit";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sport</title>
    <link rel="stylesheet" href="accessory.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
        <div class="headline">
            <h3>Phụ kiện thể thao</h3>
        </div>
        <ul class="products">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="product-item">';
                    echo '<div class="product-top">';
                    echo '<img src="' . $row['Img'] . '" alt="' . $row['Name'] . '" class="img-responsive">';
                    echo '<a href="chitietsp.php?ID='.$row['ID'].'" class="buy-now">Mua ngay</a>';
                    echo '</div>';
                    echo '<div class="product-inform">';
                    echo '<a href="#" class="product-cat">' . $row['Category'] . '</a>';
                    echo '<a href="#" class="product-name">' . $row['Name'] . '</a>';
                    echo '<div class="product-price">' . $row['Price'] . ' VND</div>';
                    echo '</div>';
                    echo '</li>';
                }
            } else {
                echo 'Không có sản phẩm nào.';
            }
            ?>
        </ul>
        <div class="pagination">
            <?php
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($current_page > 1 && $total_page > 1) {
                echo '<a href="phukien.php?page=' . ($current_page - 1) . '">Prev</a> | ';
            }

            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++) {
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page) {
                    echo '<span>' . $i . '</span> | ';
                } else {
                    echo '<a href="phukien.php?page=' . $i . '">' . $i . '</a> | ';
                }
            }

            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút next
            if ($current_page < $total_page && $total_page > 1) {
                echo '<a href="phukien.php?page=' . ($current_page + 1) . '">Next</a> | ';
            }
            ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>

</body>

</html>