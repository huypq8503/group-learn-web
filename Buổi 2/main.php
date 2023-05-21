<?php
var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
            <div>
                <label for="">Họ và tên</label>
                <input type="text" name="ten"> <br>
                <label for="">Giới tính</label>
                <input type="radio" name="gioiTinh" value="Nam" id="">Nam
                <input type="radio" name="gioiTinh" value="Nữ" id="">Nữ
                <br>
                <label for="">Nghề nghiệp</label>
                <select name="ngheNghiep" id="">
                    <option selected>Chọn nghề nghiệp</option>
                    <option value="Giảng viên">Giảng viên</option>
                    <option value="Sinh viên">Sinh viên</option>
                </select><br>
                <label for="">Chọn sản phẩm tham gia</label>
                <select name="sanPham" id="">
                    <option value="Kem đánh răng">Kem đánh răng</option>
                    <option value="Bột giặt">Bột giặt</option>
                    <option value="Sữa tắm">Sữa tắm</option>
                </select>
            </div>
            <button type="submit">Đăng kí</button>
        </form>
    </div>
</body>

</html>