<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nhập mã điện thoai</label>
                <input name="maDienThoai" type="text">
            </div>
            <button type="submit">Tìm</button>
        </form>
    </div>
</body>
<?php
$connection = new PDO("mysql:host = localhost;dbname=quanLyDienThoai;charset:utf8", "root", "");
$idDt = $_POST['maDienThoai'];
$sql = "SELECT * FROM dienThoai WHERE maDienThoai = '$idDt'";
$stmt = $connection->prepare($sql);
$stmt->execute();
$item = $stmt->fetch();
echo $item['tenDienThoai'];
?>

</html>