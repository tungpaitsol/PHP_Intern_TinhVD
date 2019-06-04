<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
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
	<?php
$data=file_get_contents("./data.json");
$data=json_decode($data,true);
foreach ($data as $key) {
			echo('<tr><td>'.$key["id"].'</td><td>'.$key["name"].'</td><td>'.$key["price"].'</td><td>'.$key["quantity"].'</td><td>'.$key["order"].'</td><td>'.$key["sum"].'</td></tr>');
}
?>
</table>
<form method="post">
		<input type="submit" name="priceh" value="PRICE >>">
		<input type="submit" name="pricel" value="PRICE <<">
		<input type="submit" name="orderh" value="ORDER >>">
		<input type="submit" name="orderl" value="ORDER <<">
		<input type="submit" name="totalh" value="TOTAL MONEY >>">
		<input type="submit" name="totall" value="TOTAL MONEY <<">


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
		foreach (sortA_Z($data,"price") as $key) { 
			echo('<tr><td>'.$key["id"].'</td><td>'.$key["name"].'</td><td>'.$key["price"].'</td><td>'.$key["quantity"].'</td><td>'.$key["order"].'</td><td>'.$key["sum"].'</td></tr>');
		}
		echo '</table>';
	}
//=============sap xem tang 
function sortA_Z($data,$field){
	$p_min=0;
	$count=count($data);
	for($i = 0; $i < $count; $i++) {
		for($j = $i+1; $j < $count; $j++) {
			if($data[$j][$field] < $data[$i][$field]) {
				$p_min = $data[$j];
				$data[$j] = $data[$i];
				$data[$i] = $p_min;
			}
		}

	}
	return $data;
}
//==================sap xep giam
function sortZ_A($data,$field){
	$p_min=0;
	$count=count($data);
	for($i = 0; $i < $count; $i++) {
		for($j = $i+1; $j < $count; $j++) {
			if($data[$j][$field] < $data[$i][$field]) {
				$p_min = $data[$j];
				$data[$j] = $data[$i];
				$data[$i] = $p_min;
			}
		}

	}
	return $data;
}
?>
</body>
</html>
