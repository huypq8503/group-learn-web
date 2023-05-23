<?php
//kết nối với cơ sở dữ liệu
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'crud';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die('Không thể kết nối đến cơ sở dữ liệu: ' . $conn->connect_error);
}
//lấy dữ liệu từ bảng users hiển thị ra table
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_all($result, MYSQLI_ASSOC);
$idItem = 1;
//thực hiện thêm người dùng
if (isset($_POST['add'])) {
    //gán dữ liệu lấy được vào biến
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO users(name,email) VALUES ('$name','$email')";
    if (mysqli_query($conn, $sql)) {
        header("location:./crud.php");
        echo "thêm thành công";
    } else {
        echo "lỗi" . $conn->connect_error;
    }
}
// thực hiện xóa
if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];
    $sql = "DELETE FROM users WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "xóa thành công";
        header("location:./crud.php");
    } else {
        echo $conn->connect_error;
    }
}
//thực lấy dữ liệu của dùng hiển thị lên form
if (isset($_GET['editId'])) {
    $id = $_GET['editId'];
    $sql = "SELECT * FROM users WHERE id = $id";
    //lấy dữ liệu
    $result = mysqli_query($conn, $sql);
    $userEdit = mysqli_fetch_assoc($result);
}
//thực hiện việc sửa dữ liệu đã được lấy
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "sửa thành công";
        header("location:./crud.php");
    } else {
        echo $conn->connect_error;
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
            <input type="text" name="name"><br>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $value) : ?>
                    <tr>
                        <td><?php echo $idItem++ ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['email'] ?></td>
                        <td>
                            <a href="?editId=<?php echo $value['id'] ?>"><button>Sửa</button></a>
                            <a href="?deleteId=<?php echo $value['id'] ?>"><button>Xóa</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form action="" method="post">
            <h1>Sửa người dùng</h1>
            <input type="hidden" name="id" value="<?php if (isset($_GET['editId'])) {
                                                        echo $userEdit['id'];
                                                    }  ?>">
            <label for="">Tên</label>:
            <input type="text" name="name" value="<?php if (isset($_GET['editId'])) {
                                                        echo $userEdit['name'];
                                                    }  ?>"><br>
            <label for="">Email</label>:
            <input type="email" name="email" id="" value="<?php if (isset($_GET['editId'])) {
                                                                echo $userEdit['email'];
                                                            }  ?>"><br>
            <button type="submit" name="update">Sửa</button>
        </form>
        <div class="search">
            <h1>Tìm kiếm</h1>
            <form action="" method="post">
                <label for="">Nhập tên người dùng</label>
                <input type="search" name="name" id="">
                <button type="submit" name="search">Tìm kiếm</button>
            </form>
        </div>
        <?php
        if (isset($_POST['search'])) {
            $name = $_POST['name'];
            $sql = "SELECT * FROM users WHERE name LIKE '$name%'";
            $result = mysqli_query($conn, $sql);
            $userSearch  = mysqli_fetch_assoc($result);
            echo "tên người dùng: " . $userSearch['name'] . "<br>";
            echo "email người dùng: " . $userSearch['email'];
        }
        ?>
    </div>
</body>

</html>