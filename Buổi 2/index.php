<form action="" method="post">
    <p>N*(N-1)*(N-2)</p>
    <label for="">Nhập số N</label>
    <input name="N" type="number">
    <button type="submit">Tính</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //kiểm tra dữ liệu đã được gửi
    // var_dump($_POST);
    $n = $_POST['N'];
    $x = $n * ($n - 1) * ($n - 2);
    echo $x;
}

?>