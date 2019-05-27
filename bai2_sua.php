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
		get_input($string);
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
	function send($a,$b){
		$ar_snt=[];
		for($i=$a;$i<$b+1;$i++){
			$a=ktsnt($i);
			if($a!=""){
				array_push($ar_snt,ktsnt($i));
			}
			
		}
		if($ar_snt==null){
			echo "Không có số nguyên tố";
		}
		else{
			foreach ($ar_snt as $key ) {
				echo $key."- la snt<br>";
			}
		}		
	}
	function get_input($str2){
		$ar_value=explode(',', $str2);
		foreach ($ar_value as $key ) {
			checkvalue($key);
		}
	}
	function checkvalue($str){
		$find=strpos($str, '-');
		$val_a=substr($str,0,$find);
		$val_b=substr($str,$find+1,strlen($str));
		if($find==null || (int)$val_a<0 || (int)$val_b==0){
			echo '<script>alert("Giá trị nhập không hợp lệ");</script>';
			return false;
		}
		send($val_a,$val_b);
		return "Giá trị a".$val_a." Giá trị b".$val_b;		
	}
	?>
</body>
</html>
