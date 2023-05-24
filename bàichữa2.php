<!doctype html>
<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'ql_sp';
$connect = mysqli_connect($servername, $username, $password, $database);
if ($connect->connect_error) {
	die("không thể kết nối đến cơ sở dữ liệu:") . $connect->connect_error;
}
?>
<html>

<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
</head>

<body>
	<form action="" method="post">
		<label for="selectList">Loại sản phẩm: </label>
		<select name="id_loai" id="selectList">
			<?php
			//truy vấn dữ liệu
			$sql = "select id_loai, name_loai from loaisanpham";
			$result = $connect->query($sql);
			//hiển thị danh sách
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo '<option value="' . $row['id_loai'] . '">' . $row['name_loai'] . '</option>';
				}
			}

			?>
		</select>
		<button name="search" type="submit">Tìm</button>
	</form>
	<?php
	if (isset($_POST['search'])) {
		var_dump($_POST);
		$maSP = $_POST['id_loai'];
		$sql = "select * from sanpham where loai=$maSP";
		$result = mysqli_query($connect, $sql);
	}
	?>
	<table border='1' width='70%'>
		<thead>
			<tr>
				<td width='10%'>STT</td>
				<td width='20%'>Mã sản phẩm</td>
				<td width='50%'>Tên sản phẩm</td>
				<td width='20%'>Đơn giá</td>
			</tr>
		</thead>
		<?php
		$query = mysqli_query($connect, $sql);
		for ($i = 0; $i < mysqli_num_rows($query); $i++) {
			echo "<tr>";
			$rc = mysqli_fetch_array($query, MYSQLI_ASSOC);
			echo "<td width='10%'>" . ($i + 1) . "</td>";
			echo "<td width='20%'>" . $rc['id_sp'] . "</td>";
			echo "<td width='50%'>" . $rc['name_sp'] . "</td>";
			echo "<td width='20%'>" . $rc['Giá'] . "</td>";
			echo "</tr>";
		}
		// $query = mysqli_query($connect, $sql);

		// if (mysqli_num_rows($query) > 0) {
		// 	$rc1 = mysqli_fetch_all($query, MYSQLI_ASSOC);
		// 	foreach ($rc1 as $rc){
		// 		echo "<tr>";
		// 	echo "<td width='10%'>" . ($i + 1) . "</td>";
		// 	echo "<td width='20%'>" . $rc['id_sp'] . "</td>";
		// 	echo "<td width='50%'>" . $rc['name_sp'] . "</td>";
		// 	echo "<td width='20%'>" . $rc['Giá'] . "</td>";
		// 	echo "</tr>";
		// 	}
		// }
		?>

	</table>
</body>

</html>