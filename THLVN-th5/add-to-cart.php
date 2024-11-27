<?php
session_start();/* khoi tao phien lam viec, luu tru thong tin gio hang */

// Nhận dữ liệu từ form(bieu mau)
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_image = $_POST['product_image'];
$size = $_POST['size'];
$quantity = $_POST['quantity'];
//POST; du lieu khong hien thi tren URL

// Tạo một mục giỏ hàng
$cart_item = array(
    'product_id' => $product_id,
    'product_name' => $product_name,
    'product_price' => $product_price,
    'product_image' => $product_image,
    'size' => $size,
    'quantity' => $quantity
);

// Kiểm tra xem giỏ hàng đã tồn tại trong phiên chưa
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();//Nếu chưa, nó sẽ tạo một mảng rỗng để chứa các mục trong giỏ hàng.
}

// Thêm sản phẩm vào giỏ hàng hoặc cập nhật số lượng nếu sản phẩm đã tồn tại
$found = false;
foreach ($_SESSION['cart'] as &$item) {//foreach ($array as $value)$value: Là biến đại diện cho giá trị của từng phần tử trong mảng. Biến này sẽ thay đổi mỗi lần lặp, nhận giá trị của phần tử hiện tại trong mảng.
    if ($item['product_id'] == $product_id && $item['size'] == $size) {
        $item['quantity'] += $quantity;
        $found = true;
        break;
    }
}
//duyệt qua từng mục trong giỏ hàng ($_SESSION['cart']). Nếu tìm thấy sản phẩm có product_id và size giống với sản phẩm đang được thêm vào giỏ, thì chúng ta cộng thêm số lượng mới vào mục sản phẩm đó (thay vì tạo mục mới).
if (!$found) {
    $_SESSION['cart'][] = $cart_item;// thêm một sản phẩm vào giỏ hàng, [] trong PHP được dùng để thêm phần tử mới vào mảng(nghia la: khi them 1 sp moi vao gio hang thi no se nam cuoi cung)
}
/*/ 
$_SESSION['cart']: Đây là một mảng chứa các sản phẩm trong giỏ hàng, mỗi sản phẩm là một mảng con với các thuộc tính như product_id, product_name, product_price
&$item: Nếu bạn không sử dụng tham chiếu, PHP sẽ chỉ làm việc với một bản sao của phần tử trong mảng, vì vậy bất kỳ sự thay đổi nào bạn thực hiện trên $item sẽ không ảnh hưởng đến phần tử gốc trong mảng $_SESSION['cart'].
/*/


header('Location: cart.php');//Chuyển hướng người dùng đến trang giỏ hàng
exit();
?>