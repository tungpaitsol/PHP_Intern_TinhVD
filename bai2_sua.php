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
	function show($snt){
		echo $snt." là số nguyên tố <br>";
	}
	function ktsnt($a){
		$dem=0;
			for ($i1=2;$i1<$a+1;$i1++){
				if($a%$i1==0){
					$dem++;
				}

			}
			if($dem==1){
				show($a);
				return $a;
			} 	
			return False;		
	}
	function send($a,$b){
		for($i=$a;$i<$b+1;$i++){
			ktsnt($i);
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
