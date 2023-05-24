<?php
// kết nối cơ sở dữ liệu
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ql_sach';
$conn =  mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("không thể kết nối đến cơ sở dữ liệu : " . mysqli_connect_error());
}
// lấy dữ liệu hiển thị ra table
$sql = "SELECT * FROM sach";
$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
$idItem = 1;
$idSearch = 1;
//xử lý thêm mới
if (isset($_POST['add'])) {
    // var_dump($_POST);
    $ma_sach = $_POST['ma_sach'];
    $ten_sach = $_POST['ten_sach'];
    $tac_gia = $_POST['tac_gia'];
    $nha_xuat_ban = $_POST['nha_xuat_ban'];
    $gia = $_POST['gia'];
    $the_loai = $_POST['the_loai'];
    // viết câu truy vấn
    $sql = "INSERT INTO sach(ma_sach,ten_sach,tac_gia,nha_xuat_ban,gia,the_loai) VALUES 
    ('$ma_sach','$ten_sach','$tac_gia','$nha_xuat_ban','$gia','$the_loai')";
    if (mysqli_query($conn, $sql)) {
        echo "thêm sách thành công";
        header("location: ./index.php");
    } else {
        echo "lỗi: " . mysqli_error($conn);
    }
}
//xử lý xóa

if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];
    $sql = "DELETE FROM sach WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "xóa thành công";
        header("location: ./index.php");
    } else {
        echo "lỗi: " . mysqli_error($conn);
    }
}

// lấy dữ liệu để sửa
if (isset($_GET['editId'])) {
    $id = $_GET['editId'];
    $sql = "SELECT * FROM sach WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
}
if (isset($_POST['update'])) {
    var_dump($_POST);
    $id = $_POST['id'];
    $ma_sach = $_POST['ma_sach'];
    $ten_sach = $_POST['ten_sach'];
    $tac_gia = $_POST['tac_gia'];
    $nha_xuat_ban = $_POST['nha_xuat_ban'];
    $gia = $_POST['gia'];
    $the_loai = $_POST['the_loai'];

    $sql = "UPDATE sach SET 
    ma_sach = '$ma_sach' , ten_sach = '$ten_sach', tac_gia = '$tac_gia'
    ,nha_xuat_ban = '$nha_xuat_ban',gia = '$gia',the_loai = '$the_loai' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Sửa thành công";
        header("location: ./index.php");
    } else {
        echo "lỗi: " . mysqli_error($conn);
    }
}
// xử lý tìm kiếm

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
            <input type="hidden" name="id" value="<?php
                                                    if (isset($_GET['editId'])) {

                                                        echo $product['id'];
                                                    }
                                                    ?>">
            <label for="">Mã sách</label>:
            <input type=" text" name="ma_sach" value="<?php
                                                        if (isset($_GET['editId'])) {
                                                            echo $product['ma_sach'];
                                                        }
                                                        ?>" required><br>
            <label for="">Tên sách</label>:
            <input type="text" name="ten_sach" value="<?php
                                                        if (isset($_GET['editId'])) {
                                                            echo $product['ten_sach'];
                                                        }
                                                        ?>" required><br>
            <label for="">Tác giá</label>:
            <input type="text" name="tac_gia" value="<?php
                                                        if (isset($_GET['editId'])) {
                                                            echo $product['tac_gia'];
                                                        }
                                                        ?>" required><br>
            <label for="">Nhà xuất bản</label>:
            <input type="text" name="nha_xuat_ban" value="<?php
                                                            if (isset($_GET['editId'])) {
                                                                echo $product['nha_xuat_ban'];
                                                            }
                                                            ?>" required><br>
            <label for="">Giá</label>:
            <input type="number" name="gia" value="<?php
                                                    if (isset($_GET['editId'])) {
                                                        echo $product['gia'];
                                                    }
                                                    ?>" required><br>
            <select name="the_loai" required>
                <option value="<?php
                                if (isset($_GET['editId'])) {
                                    echo $product['the_loai'];
                                }
                                ?>"><?php
                                    if (isset($_GET['editId'])) {
                                        echo $product['the_loai'];
                                    }
                                    ?></option>
                <option value="Tin học">Tin học</option>
                <option value="Ngoại ngữ">Ngoại ngữ</option>
                <option value="Toán">Toán</option>
            </select><br>
            <button type="submit" name="add">Thêm mới</button>
            <button type="submit" name="update">Sửa</button>
        </form>
        <h1>Danh sách </h1>
        <table border="1">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sách</th>
                    <th>Tên sách</th>
                    <th>Tác giả</th>
                    <th>Nhà Xuất Bản</th>
                    <th>Giá thể</th>
                    <th>Thể loại</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $value) { ?>
                <tr>
                    <td><?php echo $idItem++ ?></td>
                    <td><?php echo $value['ma_sach'] ?></td>
                    <td><?php echo $value['ten_sach'] ?></td>
                    <td><?php echo $value['tac_gia'] ?></td>
                    <td><?php echo $value['nha_xuat_ban'] ?></td>
                    <td><?php echo $value['gia'] ?></td>
                    <td><?php echo $value['the_loai'] ?></td>
                    <td>
                        <a href="?editId=<?php echo $value['id'] ?>"><button>Sửa</button></a>
                        <a href="?deleteId=<?php echo $value['id'] ?>"><button>Xóa</button></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <form action="" method="post">
            <h1>Tìm Theo mã sách</h1>
            <label for="">Nhập mã sách</label>
            <input type="text" name="ma_sach" id=""><br>
            <button name="search">Tìm kiếm</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sách</th>
                    <th>Tên sách</th>
                    <th>Tác giả</th>
                    <th>Nhà Xuất Bản</th>
                    <th>Giá thể</th>
                    <th>Thể loại</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['search'])) {
                    $ma_sach = $_POST['ma_sach'];
                    $sql = "SELECT * FROM sach WhERE ma_sach LIKE '$ma_sach%'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $searchItem = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        foreach ($searchItem as $value) {
                ?>
                <tr>
                    <td><?php echo $idSearch++ ?></td>
                    <td><?php echo $value['ma_sach'] ?></td>
                    <td><?php echo $value['ten_sach'] ?></td>
                    <td><?php echo $value['tac_gia'] ?></td>
                    <td><?php echo $value['nha_xuat_ban'] ?></td>
                    <td><?php echo $value['gia'] ?></td>
                    <td><?php echo $value['the_loai'] ?></td>
                </tr>
                <?php
                        }
                    } else {
                        echo "không tìm thấy";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>