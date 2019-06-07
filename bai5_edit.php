<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<title>Bài 5</title>
	<style>
		table, th, td {
			padding: 5px;
			border: 1px solid black;
			border-collapse: collapse;
		}
		.button{
			cursor: pointer;
			background-color: #5454ff;
			transition: all .2s ease-in-out; 
			padding: 5px;
			border: 1px;
			color: white;
			margin: 4px 2px;

		}
		.button:hover{
			
			transform: scale(1.1); 
			background-color: #2b2bff;
		}
	</style>
</head>
<body>
	<h1>Bài 5</h1>
	<table>
		<tr>
			<th>ID</th>
			<th>NAME</th>
			<th>PRICE</th>
			<th>QUANTITY</th>
			<th>ORDER</th>
		</tr>
		<form action="" method="POST">
			<?php
			$i=0;
			if(empty($_SESSION["data"])){
				$data=file_get_contents("./data.json");
				$data=json_decode($data,true);
				$_SESSION["data"]=$data;
			}
			$data=$_SESSION["data"];
			foreach ($data as $key) {
				$order=$key["order"];
				$valId=$key["id"];
				echo('<tr>
					<td>'.$key["id"].'</td>
					<td>'.$key["name"].'</td>
					<td>'.$key["price"].'</td>
					<td>'.$key["quantity"].'</td>
					<td><input type="number" min=1 name="arr['.$valId.']" value='.$order.'></td
					></tr>');
				$i++;
			}
			?>
			<input type="submit" name="sort2" value="order giảm" class="button">
			<input type="submit" name="sort" value="order tăng" class="button">
			<input type="submit" name="changer" value="SAVE" class="button">
		</form>
	</table>
	<?php
	if(isset($_POST["changer"])){ // lưu lại giá trị input vào session
		$order= $_POST["arr"];
		$i=0;
		foreach ($data as $key) {
			$id=$key["id"];
			$ord=$order[$id];
			$data[$i]["order"]=$ord;
			$i++;
		}
		$_SESSION["data"]=$data;
		echo "<script>window.location='./index1.php';</script>";
	}
	/*==============================*/
	// sắp xếp theo giá trị data đã lưu tại sesison
	if(isset($_POST["sort"])){
		sort_id(sortA_Z($data,"order"));
		echo "<script>window.location='./index1.php';</script>";	
	}
	if(isset($_POST["sort2"])){
		sort_id(sortZ_A($data,"order"));
		echo "<script>window.location='./index1.php';</script>";	
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
		$_SESSION["data"]=$data;
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
	function sort_id($data){
		$min=0;
		for($i=0;$i<count($data)-1;$i++){
			for($j=$i+1;$j<count($data);$j++){
				if($data[$j]["order"]==$data[$i]["order"]){
					if($data[$j]["id"]<$data[$i]["id"]){
						$min=$data[$j];
						$data[$j]=$data[$i];
						$data[$i]=$min;
					}
				}
			}
		}
		$_SESSION["data"]=$data;
		return $data;
		
	}
	?>
</body>
</html>
