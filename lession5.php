<?php
session_start();
?>
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
			if(empty($_SESSION["data"])){
				$data=file_get_contents("./data.json");
				$data=json_decode($data,true);
				$_SESSION["data"]=$data;	
			}
			$data=$_SESSION["data"];
			$i=0;
			foreach ($data as $key) {
				$order=$key["order"];
				echo('<tr><td>'.$key["id"].'</td><td>'.$key["name"].'</td><td>'.$key["price"].'</td><td>'.$key["quantity"].'</td><td><input type="number" min=1 name='."order".$i.' value='.$order.'></td></tr>');
				$i++;
			}
			?>

			<input type="submit" name="changer" value="changer" class="button">
		</form>
	</table>
	<?php
	if(isset($_POST["changer"])){
		for ($i=0; $i <count($data) ; $i++) { 
			$name="order".$i;
			$order= $_POST[$name];
			$data[$i]["order"]=$order;
			echo "<pre>";
		}
		sort_id(sortA_Z($data,"order"));
		echo "<script>window.location='./index1.php';</script>";
	}
//==============function show
	
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
	function sort_id($data){
		$min=0;
		for($i=0;$i<9;$i++){
			for($j=$i+1;$j<10;$j++){
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
	}
	?>
</body>
</html>
