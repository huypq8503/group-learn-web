<?php
//kết nối cơ sở dữ liệu
$host = 'localhost';
$username = 'root'; // admin
$password = ''; //123456
$database = 'ql_cb';
$conn = mysqli_connect($host, $username, $password, $database);

if ($conn->connect_error) {
    die("không thể kết nối đến cơ sở dữ liệu:") . $conn->connect_error;
}

//hiển thị ra table
$sql = "SELECT * FROM tblcanbo";
$result = mysqli_query($conn, $sql);
$canbo = mysqli_fetch_all($result, MYSQLI_ASSOC);


// thêm dữ liệu
// kiểm tra nút
if (isset($_POST['add'])) {
    $ma_caBo = $_POST['ma_canBo'];
    $cmnd = $_POST['cmnd'];
    $hovatendem = $_POST['hovatendem'];
    $ten = $_POST['ten'];
    $tinh = $_POST['tinh'];
    // truy vấn thêm dữ liệu
    $sql = "INSERT INTO tblcanbo (ma_canBo,cmnd,hovatendem,ten,tinh) VALUES ('$ma_caBo','$cmnd','$hovatendem','$ten','$tinh' ) ";
    mysqli_query($conn, $sql);
}
if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];
    $sql = "DELETE FROM tblcanbo WHERE ma_canBo = $id";
    mysqli_query($conn, $sql);
}

if (isset($_POST['delete']) && isset($_POST['deleteId'])) {
    // var_dump($_POST);
    foreach ($_POST['deleteId'] as $id) {
        $sql = "DELETE FROM tblcanbo WHERE ma_canBo = $id";
        mysqli_query($conn, $sql);
    }
}
// hiển thị để sửa
if (isset($_GET['editId'])) {
    $id = $_GET['editId'];
    $sql = "SELECT * FROM tblcanbo WHERE ma_canBo = $id";
    $result = mysqli_query($conn, $sql);
    $canboEdit = mysqli_fetch_assoc($result);
}

// thực hiện sửa
if (isset($_POST['update'])) {
    $ma_caBo = $_POST['ma_canBo'];
    $cmnd = $_POST['cmnd'];
    $hovatendem = $_POST['hovatendem'];
    $ten = $_POST['ten'];
    $tinh = $_POST['tinh'];
    $sql = "UPDATE tblcanbo SET ma_canBo = '$ma_caBo' , cmnd = '$cmnd' , hovatendem = '$hovatendem' , ten = '$ten',tinh='$tinh' WHERE ma_canBo = $ma_caBo";
    mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <label for="">Mã Cán Bộ</label>:
            <input type="text" name="ma_canBo" value="<?php if (isset($_GET['editId'])) {
                                                            echo $canboEdit['ma_canBo'];
                                                        } ?>"><br>
            <label for="">Số CMND</label>:
            <input type="text" name="cmnd" value="<?php echo $canboEdit['cmnd'] ?>"><br>
            <label for="">Họ và tên đệm</label>:
            <input type="text" name="hovatendem" value="<?php echo $canboEdit['hovatendem'] ?>"><br>
            <label for="">Tên</label>:
            <input type="text" name="ten" value="<?php echo $canboEdit['ten'] ?>"><br>
            <label for="">Tỉnh thành phố</label>
            <select name="tinh">
                <option value="<?php echo $canboEdit['tinh'] ?>"><?php echo $canboEdit['tinh'] ?></option>
                <option value="Hà Nội">Hà Nội</option>
                <option value="Huế">Huế</option>
                <option value="Hải Phòng">Hải Phòng</option>
            </select> <br>

            <button type="submit" name="add">Thêm</button>
            <button type="submit" name="update">Sửa</button>
            <button type="submit" name="delete">Xóa</button>
            <table border="1">
                <thead>
                    <tr>
                        <th>Mã cán bộ</th>
                        <th>Số CMND</th>
                        <th>Họ và tên đệm</th>
                        <th>Tên</th>
                        <th>Chi tiết</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($canbo as $value) { ?>
                        <tr>
                            <td><?= $value['ma_canBo'] ?></td>
                            <td><?php echo $value['cmnd'] ?></td>
                            <td><?php echo $value['hovatendem'] ?></td>
                            <td><?php echo $value['ten'] ?></td>
                            <td>
                                <a href="?editId=<?php echo $value['ma_canBo'] ?>" class="">Sửa</a>
                            </td>
                            <td>
                                <a href="?deleteId=<?php echo $value['ma_canBo'] ?>" class="">Xóa</a>
                                <input type="checkbox" name="deleteId[]" value="<?php echo $value['ma_canBo'] ?>">
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
</body>

</html>