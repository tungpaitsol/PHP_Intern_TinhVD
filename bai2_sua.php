<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tìm số nguyên tố</title>
</head>
<body>
	<form method="POST" action="">
		<input type="text" name="put" placeholder="Nhập 2 số có dạng a-b">
		<input type="submit" name="submit" >
	</form>
	<?php
	if(isset($_POST['submit'])){
		$string=$_POST["put"];
		check_input($string);
	}
	function ktsnt($a){
		if ($a < 2) {
			return false;
		}
		for($i = 2; $i <= sqrt ( $a ); $i ++) {
			if ($a % $i == 0) {
				return false;
			}
		}
		return $a;		
	}
	function xuat_snt($a,$b){
		$ar_snt=[];
		for($i=$a;$i<=$b;$i++){
			$c=ktsnt($i);
			if($c!=""){
				array_push($ar_snt,$i);
			}
		}
		if($ar_snt==null){
			echo "<br>$a - $b không có số nguyên tố";
		}
		else{
			echo "<br>số nguyên tố trong khoảng $a - $b: ";
			foreach ($ar_snt as $snt) {
				echo $snt." ";
			}
		}
	}
	function check_input($str2){

		$ar_value=explode(',', $str2);
		foreach ($ar_value as $str ) {
			$find=strpos($str, '-');
			$val_a=substr($str,0,$find);
			$val_b=substr($str,$find+1,strlen($str));
			if($find==null || is_numeric($val_a)==false || is_numeric($val_b)==false){
				echo "Giá trị nhập không hợp lệ";
			}
			else{
				xuat_snt($val_a,$val_b);
			}
			
		}
	}
	?>
</body>
</html>
