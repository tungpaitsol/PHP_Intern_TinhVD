<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>STORE</title>
	<style>
		table, th, td {
			padding: 5px;
			border: 1px solid black;
			border-collapse: collapse;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<th>ID</th>
			<th>NAME</th>
			<th>PRICE</th>
			<th>QUANTITY</th>
			<th>ORDER</th>
			<th>SUM</th>
		</tr>
		<?php // lay gia tri file json dua vao cac mang rieng biet
		$data=file_get_contents("./data.json");
		$file=json_decode($data);
		$id=[];
		$name=[];
		$price=[];
		$quantity=[];
		$order=[];
		foreach ($file as $key) {
			array_push($id,$key->id);
			array_push($name,$key->name);
			array_push($price,$key->price);
			array_push($quantity,$key->quantity);
			array_push($order,$key->order);
		}
		for ($i=0; $i <10 ; $i++) { 
			echo('<tr><td>'.$id[$i].'</td><td>'.$name[$i].'</td><td>'.$price[$i].'</td><td>'.$quantity[$i].'</td><td>'.$order[$i].'</td><td>'.$order[$i]*$price[$i].'</td></tr>');
		}
		?>
	</table>
	<form method="post">
		<input type="submit" name="priceh" value="PRICE >>">
		<input type="submit" name="pricel" value="PRICE <<">
	</form>
	<?php
	if(isset($_POST["priceh"])){ // click button tang theo gia
		echo '	<table>
		<tr>
			<th>ID</th>
			<th>NAME</th>
			<th>PRICE</th>
			<th>QUANTITY</th>
			<th>ORDER</th>
			<th>SUM</th>
		</tr>';
		foreach (sort_id($price,sortA_Z($price)) as $i) { 
			echo('<tr><td>'.$id[$i].'</td><td>'.$name[$i].'</td><td>'.$price[$i].'</td><td>'.$quantity[$i].'</td><td>'.$order[$i].'</td><td>'.$order[$i]*$price[$i].'</td></tr>');
		}
		echo '</table>';
	}
	/* ham xap xep gia tri tang theo tung truong*/
	function sortA_Z($field){
		$A_Z=$field;
		$p_min=0;
		$count=count($field);
		for($i = 0; $i < $count; $i++) {
			for($j = $i+1; $j < $count; $j++) {
				if($A_Z[$j] < $A_Z[$i]) {
					$p_min = $A_Z[$j];
					$A_Z[$j] = $A_Z[$i];
					$A_Z[$i] = $p_min;
				}
			}
			
		}
		return $A_Z;
	}
	/* ham lay thu tu id da sap xep o mang tren theo mang cu*/
	function sort_id($field,$ar_sort_field){
		$ar_id_sortAZ=[];
		$ar_sort=$ar_sort_field;
		$count=count($ar_sort);
		for($a=0;$a<$count;$a++){
			for ($b=0;$b<$count;$b++){
				if($ar_sort[$a]==$field[$b]){
					array_push($ar_id_sortAZ,$b);
				}
			}
		}
		return $ar_id_sortAZ;
	}
	?>
</body>
</html>
