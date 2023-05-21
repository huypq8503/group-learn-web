<?php
include "./config.php";
$query = "SELECT maDienThoai,tenDienThoai,tinhNang,gia,tenHang  FROM `dienthoai` INNER JOIN hang ON dienthoai.idHang = hang.id";
$item = getAll($query);

$id = 1;
// var_dump($item)

?>
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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mã điện thoại</th>
                    <th scope="col">Tên điện thoại</th>
                    <th scope="col">Tính năng</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Hãng</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($item as $value) ?>
                <tr>
                    <th scope="row"><?php echo $id++ ?></th>
                    <td><?php echo $value['maDienThoai'] ?></td>
                    <td><?php echo $value['tenDienThoai'] ?></td>
                    <td><?php echo $value['tinhNang'] ?></td>
                    <td><?php echo $value['gia'] ?></td>
                    <td><?php echo $value['tenHang'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>