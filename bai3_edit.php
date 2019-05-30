<?php
session_start();
if(empty($_SESSION["m_array"])){
	$m_array=[];
}
else{
	$m_array=$_SESSION["m_array"];
}
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
	if(isset($_POST["start_array"])){
		$n=$_POST["inputN"];
		echo "<pre>";
		print_r(khoiTaoMang($n)) ;
	}
	function random($input, $strlength) {
		$input_length = strlen($input);
		$random_string="";
		$a=$input[mt_rand(0, $input_length - 1)];
		if($a==0){
			$a = $input[mt_rand(1, $input_length - 1)];
			for($i = 0; $i < $strlength-1; $i++) {
				$random_string .= $input[mt_rand(0, $input_length - 1)];
			}
			return $a.$random_string;
		}
		else{
			for($i = 0; $i < $strlength-1; $i++) {
				$random_string .= $input[mt_rand(0, $input_length - 1)];
			}	
			return $a.$random_string;
		}
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
				array_push($array1,$a);
			}
			else{
				$b=random($chars,$length);
				array_push($array1,$b);
			}				
		}
		$_SESSION["m_array"]=$array1;
		return $array1;
	}
	if(isset($_POST["div_array"])){
		echo "<pre>";
		chiaMang($m_array);
	}
	function chiaMang($m_array){
		$arrayStr=[];
		$arrayInt=[];
		foreach ($m_array as $key) {
			if(is_numeric($key)){
				array_push($arrayInt,$key);
			}
			else  if(is_string($key)){
				array_push($arrayStr,$key);
			}
		}
		//echo "Mảng string là";
		//echo "<pre>";
		print_r($arrayStr);
		//echo "Mảng INT là";
		//echo "<pre>";
		print_r($arrayInt);
	}
	?>
</body>
</html>
