<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Random</title>
</head>
<body>
	<form method="POST" action="">
		<input type="number" name="inputN" min="4" value="<?php echo $n=$_POST["inputN"];?>">
		<br>
		<input type="submit" name="start_array" value="Khởi tạo mảng">
		<input type="submit" name="div_array" value="Chia mảng">
	</form>
	<br>
	<?php
	$arrayStr=[];
	$arrayInt=[];
	
	function random($input, $strength) {
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_string .= $input[mt_rand(0, $input_length - 1)];
		}
		return $random_string;
	}
	if(isset($_POST["start_array"])){
		$n=$_POST["inputN"];
		khoiTaoMang($n);
	}
	function khoiTaoMang($n){
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$number="0123456789";
		$array1=[];
		for($i=0;$i<$n;$i++){
			$type=mt_rand(1,2);
			$length=mt_rand($n/4,(3*$n)/4);
			if($type==1){
				$a=random($number,$length);
				array_push($array1,(int)$a);
			}
			else{
				$b=random($chars,$length);
				array_push($array1,$b);
			}				
		}
		$_SESSION["m_array"]=$array1;
		print_r($array1);
	}
	if(isset($_POST["div_array"])){
		foreach ($_SESSION["m_array"] as $key) {
			if(is_string($key)){
				array_push($arrayStr,$key);
			}
			else if(is_int($key)){
				array_push($arrayInt,$key);
			}
		}
		echo "Mảng string là";
		echo "<br>";
		print_r($arrayStr);
		echo "<br>";
		echo "Mảng INT là";
		echo "<br>";
		print_r($arrayInt);
	}
	?>
</body>
</html>
