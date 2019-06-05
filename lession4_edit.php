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
			echo('<tr><td>'.$key["id"].'</td><td>'.$key["name"].'</td><td>'.$key["price"].'</td><td>'.$key["quantity"].'</td><td>'.$key["order"].'</td><td>'.$key["price"]*$key["order"].'</td></tr>');
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
	show(sortA_Z($data,"price"));
}
//============================
if(isset($_POST["pricel"])){ // click button tang theo gia
	show(sortZ_A($data,"price"));
}
//============================
if(isset($_POST["orderh"])){ // click button tang theo gia
	show(sortA_Z($data,"order"));
}
//============================
if(isset($_POST["orderl"])){ // click button tang theo gia
	show(sortZ_A($data,"order"));
}
//============================click 
if(isset($_POST["totalh"])){ // click button tang theo gia
	for ($i=0; $i <count($data) ; $i++) { 
		$data[$i]["sum"]=$data[$i]["price"]*$data[$i]["order"];
	}
	show(sortA_Z($data,"sum"));
}
//============================click 
if(isset($_POST["totall"])){ // click button tang theo gia
	for ($i=0; $i <count($data) ; $i++) { 
		$data[$i]["sum"]=$data[$i]["price"]*$data[$i]["order"];
	}
	show(sortZ_A($data,"sum"));
}
//==============function show
function show($array_sort){
	echo '	<table>
	<tr>
	<th>ID</th>
	<th>NAME</th>
	<th>PRICE</th>
	<th>QUANTITY</th>
	<th>ORDER</th>
	<th>SUM</th>
	</tr>';
	foreach ($array_sort as $key) { 
		echo('<tr><td>'.$key["id"].'</td><td>'.$key["name"].'</td><td>'.$key["price"].'</td><td>'.$key["quantity"].'</td><td>'.$key["order"].'</td><td>'.$key["price"]*$key["order"].'</td></tr>');
	}
	echo '</table>';
}
//=============sap xem tang 
function sortA_Z($data,$field){
	$p_min=0;
	$count=count($data);
	for($i = 0; $i < $count; $i++) {
		for($j = $i+1; $j < $count-1; $j++) {
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
	$p_max=0;
	$count=count($data);
	for($i = 0; $i < $count; $i++) {
		for($j = $i+1; $j < $count-1; $j++) {
			if($data[$j][$field] > $data[$i][$field]) {
				$p_max = $data[$j];
				$data[$j] = $data[$i];
				$data[$i] = $p_max;
			}
		}

	}
	return $data;
}
?>
</body>
</html>
