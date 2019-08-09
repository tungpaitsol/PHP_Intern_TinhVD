<?php
include("./oopclass.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Xác nhận thông tin đăng ký</title>
</head>
<body>
	<form method="POST">
		<div class="form-group">
			<label for="exampleInputEmail1">Tên khách hàng</label>
			<input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Vui lòng điền tên của bạn">
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Số điện thoại</label>
			<input type="text" class="form-control" name="numberPhone" placeholder="Vui lòng điến số điện thoại của bạn">
		</div>
		<div class="form-check">
			<input type="checkbox" class="form-check-input" id="exampleCheck1">
			<label class="form-check-label" for="exampleCheck1">Yêu cầu gọi điện xác nhận từ quản lý</label>
		</div>
		<button type="submit" class="btn btn-primary" name="regist">Đăng ký</button>
		<button type="submit" class="btn btn-warning" name="destroy">Hủy bỏ</button>
	</form>
</body>
</html>
<?php
if(isset($_POST['regist'])){
	$nameUser=$_POST['name'];
	$numberPhone=$_POST['numberPhone'];
	foreach ($_SESSION['dataUserRegister'] as $data) {
		$countHorse=count($data['nameHorse']);
		for ($i=0;$i<$countHorse;$i++){
			if($data['nameHorse'][$i]!=""){
				$infoData=["",$nameUser,$numberPhone,$data['dateVisit'],$data['nameRanch'],$data['time_of_day'],$data['nameHorse'][$i],$data['visit_other_club'][$i]];
				addInfoCustomer($infoData,$conn);
			}
		}
	}
	echo "<script>window.location='./userRegister.php';</script>";
}
function addInfoCustomer($data,$conn){
	$sqlInsert = $conn->prepare('INSERT INTO register_visit_horse_info (id,nameCustomer,phoneCustomer,	dateVisit,	nameRanch,time_visit,	name_horse,number_horse_other_club) values (?, ?, ?, ?,?, ?, ?,?)');
	$sqlInsert->execute($data);
	session_destroy();
	echo '<script>window.location="./index.php"</script>';
}
if(isset($_POST['destroy'])){
	session_destroy();
	echo '<script>window.location="./index.php"</script>';
}
?>