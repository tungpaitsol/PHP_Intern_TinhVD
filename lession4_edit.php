<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<title>Bài 4 Sắp xếp giá trị trong data</title>
	<style>
		table, th, td {
			padding: 5px;
			border: 1px solid black;
			border-collapse: collapse;
		}
		input{
			cursor: pointer;
			background-color: #5454ff;
			transition: all .2s ease-in-out; 
			padding: 5px;
			border: 1px;
			color: white;
			margin: 4px 2px;

		}
		input:hover{
			
			transform: scale(1.1); 
			background-color: #2b2bff;
		}
	</style>
</head>
<body>
	<?php
	$data=file_get_contents("./data.json");
	$data=json_decode($data,true);
	echo show($data);
	?>
	<form method="post">
		<input type="submit" name="priceh" value="PRICE ⬆️">
		<input type="submit" name="pricel" value="PRICE ⬇">
		<input type="submit" name="orderh" value="ORDER ⬆️">
		<input type="submit" name="orderl" value="ORDER ⬇">
		<input type="submit" name="totalh" value="TOTAL MONEY ⬆️">
		<input type="submit" name="totall" value="TOTAL MONEY ⬇">
	</form>
</div>
<div class="table2">
	<?php
	if(isset($_POST["priceh"])){
		echo show(sortA_Z($data,"price"));
	}
//============================
	if(isset($_POST["pricel"])){ 
		echo show(sortZ_A($data,"price"));
	}
//============================
	if(isset($_POST["orderh"])){ 
		echo show(sortA_Z($data,"order"));
	}
//============================
	if(isset($_POST["orderl"])){ 
		echo show(sortZ_A($data,"order"));
	}
//============================click 
	if(isset($_POST["totalh"])){ 
		echo show(sortSumA_Z($data,"order"));
	}
//============================click 
	if(isset($_POST["totall"])){ 
		echo show(sortSumZ_A($data));
	}
//==============function show
	function show($array_sort){
		$a= '	<table>
		<tr>
		<th>ID</th>
		<th>NAME</th>
		<th>PRICE</th>
		<th>QUANTITY</th>
		<th>ORDER</th>
		<th>SUM</th>
		</tr>';
		foreach ($array_sort as $key) { 
			$a.='<tr>
			<td>'.$key["id"].'</td>
			<td>'.$key["name"].'</td>
			<td>'.$key["price"].'</td>
			<td>'.$key["quantity"].'</td>
			<td>'.$key["order"].'</td>
			<td>'.$key["price"]*$key["quantity"].'</td>
			</tr>';
		}
		$a.= '</table>';
		return $a;
	}
//=============sap xem tong
	function sortSumA_Z($data){
		$p_min=0;
		$count=count($data);
		for($i = 0; $i < $count-1; $i++) {
			for($j = $i+1; $j < $count; $j++) {
				$a=$data[$i]["price"]*$data[$i]["quantity"];
				$b=$data[$j]["price"]*$data[$j]["quantity"];
				if($b <$a ) {
					$p_min = $data[$j];
					$data[$j] = $data[$i];
					$data[$i] = $p_min;
				}
			}

		}
		return $data;
	}
//===========================
	function sortSumZ_A($data){
		$p_max=0;
		$count=count($data);
		for($i = 0; $i < $count-1; $i++) {
			for($j = $i+1; $j < $count; $j++) {
				$a=$data[$i]["price"]*$data[$i]["quantity"];
				$b=$data[$j]["price"]*$data[$j]["quantity"];
				if($b >$a ) {
					$p_max = $data[$j];
					$data[$j] = $data[$i];
					$data[$i] = $p_max;
				}
			}

		}
		return $data;
	}
//=============sap xem tang 
	function sortA_Z($data,$field){
		$p_min=0;
		$count=count($data);
		for($i = 0; $i < $count-1; $i++) {
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
		$p_max=0;
		$count=count($data);
		for($i = 0; $i < $count-1; $i++) {
			for($j = $i+1; $j < $count; $j++) {
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
</div>
</div>
</body>
</html>
