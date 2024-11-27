<?php include 'header.php'; ?>
<?php include 'poster.php'; ?>

<?php include 'connect.php';?>
<!-- lấy 15 sản phẩm mặc định -->
<?php
$sql = "SELECT * FROM products LIMIT 15";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Body</title>
    <link rel="stylesheet" href="index.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
        <div class="headline">
            <h3>Sản phẩm bán chạy</h3>
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
    </div>
    <?php include 'footer.php'; ?>
</body>