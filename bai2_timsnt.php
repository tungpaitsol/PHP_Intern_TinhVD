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
		checkvalue($string);

	}
	function snt($a,$b){
		$ar_snt=[];
		$dem=0;
		for($i=$a;$i<$b+1;$i++){
			for ($i1=2;$i1<$i+1;$i1++){
				if($i%$i1==0){
					$dem++;
				}

			}
			if($dem==1){
				array_push($ar_snt, $i);
			} 
			
			$dem=0;
		}
		show($ar_snt);
		return $ar_snt;
	}
	function show($array){
		if($array==null){
			echo "Không có số nguyên tố";
		}
		foreach ($array as $key ) {
			echo "Số nguyên tố là ".$key."<br>";
			# code...
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
		snt($val_a,$val_b);
		return $val_a;
		return $val_b;
	}
	?>
</body>
</html>