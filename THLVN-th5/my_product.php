<?php
$servername="localhost";
$username="root";
$password="";
$dbname="product";
//ket noi co so du lieu
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("Ket noi that bai!".$conn->connect_error);
}
$conn->set_charset("utf-8"); // Thiết lập mã hóa ký tự

//Them sp
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['add'])){
    $img= $_POST['img'];
    $mauao=$_POST['mauao'];
    $tendoi=$_POST['tendoi'];
    $price=$_POST['price'];

    $sql = "INSERT INTO my_product(Img,Mauao,Tendoi,Price)
    VALUE ('$img', '$mauao', '$tendoi', '$price')";
    $conn->query($sql);
}
//xoa san pham
if(isset($_POST['delete'])){
    $id=$_POST['id'];
    $sql= "DELETE FROM my_product WHERE ID='$id";
    $conn->query($sql);
}
 // Xử lý sửa sản phẩm
 if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $img = $_POST['img'];
    $mauao = $_POST['mauao'];
    $tendoi = $_POST['tendoi'];
    $price = $_POST['price'];

    $sql = "UPDATE my_product SET Img='$img', Mauao='$mauao', Tendoi='$tendoi', Price='$price' WHERE ID='$id'";
    $conn->query($sql);
}
}
// Lấy danh sách sản phẩm
$sql = "SELECT * FROM my_product";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="my_product.css">
</head>

<body>
    <h1>Danh sách sản phẩm</h1>
    <table border="1px">
        <tr>
            <th>ID</th>
            <th>Ảnh</th>
            <th>Màu áo</th>
            <th>Tên đội</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><img src="<?php echo $row['Img']; ?>" alt="Ảnh sản phẩm" width="100"></td>
            <td><?php echo $row['Mauao']; ?></td>
            <td><?php echo $row['Tendoi']; ?></td>
            <td><?php echo $row['Price']; ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                    <input type="submit" name="delete" value="Xóa">
                </form>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                    <input type="text" name="img" value="<?php echo $row['Img']; ?>">
                    <input type="text" name="mauao" value="<?php echo $row['Mauao']; ?>">
                    <input type="text" name="tendoi" value="<?php echo $row['Tendoi']; ?>">
                    <input type="text" name="price" value="<?php echo $row['Price']; ?>">
                    <input type="submit" name="edit" value="Sửa">
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

    <h2>Thêm sản phẩm mới</h2>
    <form method="post">
        <input type="text" name="img" placeholder="URL ảnh">
        <input type="text" name="mauao" placeholder="Màu áo">
        <input type="text" name="tendoi" placeholder="Tên đội">
        <input type="text" name="price" placeholder="Giá">
        <input type="submit" name="add" value="Thêm">
    </form>
</body>

</html>

<?php
$conn->close();
?>