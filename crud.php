<?php
//kết nối với cơ sở dữ liệu
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'crud';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("không thể kết nối đến cơ sở dữ liệu:") . $conn->connect_error;
}

// lấy dữ liệu và hiển thị
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
$idItem = 1;
// var_dump($user);
//xử lý thêm dữ liệu
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO users (name,email) VALUES ('$name','$email')";
    if (mysqli_query($conn, $sql)) {
        echo "thêm thành công";
        header("location:./crud.php");
    } else {
        echo "lỗi" . $conn->connect_error;
    }
}
//xử lý xóa dữ liệu
if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];
    $sql = "DELETE FROM users WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "xóa thành công";
        header("location:./crud.php");
    } else {
        echo "lỗi" . $conn->connect_error;
    }
}
// lấy dữ liệu cần sửa
if (isset($_GET['editId'])) {
    $id = $_GET['editId'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $editUser = mysqli_fetch_assoc($result);
}

//cập nhật lại dữ liệu
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "UPDATE users SET name = '$name' , email = '$email' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "thêm thành công";
        header("location:./crud.php");
    } else {
        echo "lỗi" . $conn->connect_error;
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
            <h1>Thêm người dùng</h1>
            <label for="">Tên</label>:
            <input type="text" name="name" id=""><br>
            <label for="">Email</label>:
            <input type="email" name="email" id=""><br>
            <button type="submit" name="add">Thêm</button>
        </form>
        <h1>Danh sách người dùng</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $value) { ?>
                <tr>
                    <td><?php echo $idItem++ ?></td>
                    <td><?php echo  $value['name'] ?> </td>
                    <td><?php echo $value['email'] ?></td>
                    <td>
                        <a href="./crud.php?editId=<?php echo $value['id'] ?>"><button>Sửa</button></a>
                        <a href="./crud.php?deleteId=<?php echo $value['id'] ?>"><button>Xóa</button></a>
                    </td>
                </tr>
                <?php }; ?>
            </tbody>
        </table>
        <form action="" method="post">
            <h1>Sửa người dùng</h1>
            <input type="hidden" name="id" value="<?php if (isset($_GET['editId'])) {
                                                        echo $editUser['id'];
                                                    }  ?>">
            <label for="">Tên</label>:
            <input type="text" name="name" value="<?php if (isset($_GET['editId'])) {
                                                        echo $editUser['name'];
                                                    }  ?>" id=""><br>
            <label for="">Email</label>:
            <input type="email" name="email" value="<?php if (isset($_GET['editId'])) {
                                                        echo $editUser['email'];
                                                    }  ?>" id=""><br>
            <button type="submit" name="update">Sửa</button>
        </form>


        <form action="" method="post">
            <label for="">Nhập tên</label>:
            <input type="text" name="name" id="">
            <button name="search" type="submit">Tìm kiếm</button>
        </form>
        <?php
        if (isset($_POST['search'])) {
            $name = $_POST['name'];
            $sql = "SELECT * FROM users WHERE name LIKE '$name%'";
            $result = mysqli_query($conn, $sql);
            $userSearch = mysqli_fetch_all($result,MYSQLI_ASSOC);
            foreach ($userSearch as $user) {
                echo "Tên: " . $user['name'] . "<br>";
                echo "Email: " . $user['email'] . "<br>";
            }
        }

        ?>
    </div>
</body>

</html>