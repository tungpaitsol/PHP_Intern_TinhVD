<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1> Giải phương trình bậc 2 </h1>
	<h2>ax^2+bx+c=0</h2>
	<form method="POST" action="">
		<input type="number" name="valuea" placeholder="Nhập giá trị a">
		<input type="number" name="valueb" placeholder="Nhập giá trị b">
		<input type="number" name="valuec" placeholder="Nhập giá trị c">
		<input type="submit" name="submit">
	</form>
	<br>
	<?php
	if(isset($_POST['submit'])){
		$a=$_POST["valuea"];
		$b=$_POST["valueb"];
		$c=$_POST["valuec"];

		echo "Số vừa nhập a=".$a.", b=".$b.", c=".$c."<br>";

		if($a==0){
			$x=-$c/$b;
			echo "Phương trình có nghiệm: x=".$x;
			return $x;		
		}
		else{
			$delta=$b*$b-4*$a*$c;
			if($delta<0){
				echo "Phương trình vô nghiệm";
			}
			else if($delta==0){
				$x=-$b/$a*2;
				echo "Phương trình có nghiệm kép: x=".$x;
				return $x;
			}
			else{
				$x1=(-$b+sqrt($delta))/($a*2);
				$x2=(-$b-sqrt($delta))/($a*2);
				echo "Phương trình có 2 nghiệm phân biệt: x1=".$x1." và x2=".$x2;
				return $x1;
				return $x2;
			}
		}
	}
	?>
</body>
</html>