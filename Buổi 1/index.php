<style>
    input {
        width: 50px;
    }
</style>
<h1>Giải phương trình bậc nhất</h1>
<form action="" method="POST">
    <input name="a" type="text">x + <input name="b" type="text"> = 0
    <button>Tính</button>
</form>

<?php
// var_dump($_GET)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $a = $_POST['a'];
    $b = $_POST['b'];
    echo $a . $b;
    // if ($a == 0) {
    //     if ($b == 0) {
    //         echo "Phường trinhg vô số nghiệm";
    //     } else {
    //         echo "Phương trình vô nghiệm";
    //     }
    // } else {
    //     $x = ($b / $a);
    //     echo "Phương trình có 1 nghiệm duy nhất là" . $x;
    // }
}

?>