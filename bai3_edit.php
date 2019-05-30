<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
	function random($input, $strlength) {
		$input_length = strlen($input);
		$random_string="";
		
		$a=$input[mt_rand(0, $input_length - 1)];
		if($a==0){
			$a = $input[mt_rand(1, $input_length - 1)];
			for($i = 0; $i < $strlength-1; $i++) {
				$random_string .= $input[mt_rand(0, $input_length - 1)];
			}
			$random_string=$a.$random_string;
		}
		else{
			for($i = 0; $i < $strlength-1; $i++) {
				$random_string .= $input[mt_rand(0, $input_length - 1)];
			}	
			$random_string=$a.$random_string;
		}*/
		return $random_string;
	}
	echo random("01",5);
	?>
</body>
</html>
