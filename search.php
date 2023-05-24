<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ql_sp';
$conn = mysqli_connect($host, $username, $password, $database);
if ($conn->connect_error) {
    die("không thể kết nối đến cơ sở dữ liệu:") . $conn->connect_error;
}
$stt = 1;
$sql = "SELECT * FROM loaisanpham";
$result = mysqli_query($conn, $sql);
$category = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (isset($_POST['search'])) {
    // var_dump($_POST);
    $id = $_POST['cateId'];
    $sql = "SELECT * FROM sanpham WHERE loai = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "hông tìm thấy";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <h1>Tìm sản phẩm</h1>
            <select name="cateId" id="" required>
                <option value="" selected>Chọn loại</option>
                <?php foreach ($category as $value) : ?>
                    <option value="<?php echo $value['Id_loai'] ?>"><?php echo $value['name_loai'] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="search">Tìm kiếm</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($product as $value) : ?>
                    <tr>
                        <td><?php echo $stt++ ?></td>
                        <td><?php echo $value['name_sp'] ?></td>
                        <td><?php echo $value['gia'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>