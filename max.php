<form action="" method="post">
    <label for="">Nhập số A</label>:
    <input type="text" name="a" id=""><br>
    <label for="">Nhập số B</label>:
    <input type="text" name="b" id=""><br>
    <label for="">Nhập số C</label>:
    <input type="text" name="c" id=""><br>
    <button type="submit" name="submit">Tính</button>
</form>
<?php
if (isset($_POST['submit'])) {
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];

    $max = max($a, $b, $c);
    echo "số lớn nhất" . $max;
}

?>