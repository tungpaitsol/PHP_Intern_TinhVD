<?php
include ("./oopclass.php");
if(isset($_POST['date'])){
	$shows->setRanchAndTime($conn,$_POST['date']);
	$farms=$shows->getFarm();
	$timeVisits=$shows->getTimeVisit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>VIEW INFO</title>
</head>
<body>
	<div class="selectForm" style="margin: 5px 0">
		<div style="float: left;    width: fit-content;">
			<form method="POST">
				<input type="date" name="date" value="<?php if(isset($_POST['date'])){echo date("Y-m-d",strtotime($_POST['date']));}?>" style="    padding: 5px;border-radius: 10px;border: 1px solid red;outline: none;" onchange="this.form.submit()"> 
			</form>
		</div>
		<div class="show" style="float: left">
			<?php
			if(!isset($_POST['date'])) exit;
			for($timeOfDay=0;$timeOfDay<count($timeVisits);$timeOfDay++){
				foreach ($farms as $nameFarm) {
					$infoDetails[]=$shows->getInfoAll($timeVisits[$timeOfDay],$nameFarm,$_POST['date'],$conn);
				}
			}
			if(!isset($infoDetails)){
				echo("<script>alert('Không có thông tin để hiển thị');</script>");
				 exit;
			}
			view($infoDetails,$timeVisits,$farms);
			function view($infoDetails,$timeVisits,$farms){
				echo '<table class="table table-bordered table-dark">
				<thead>
				<tr ><th></th>';
				for($nongtrai=0;$nongtrai<count($farms);$nongtrai++){
					echo '<th scope="col" value="'.$farms[$nongtrai].'" name="ahihi[]">'.$farms[$nongtrai].'</th>';
				}
				echo '</tr></thead><tbody>';
				$stt=0; // ma tran tinh theo cot x hang
				for($i=0;$i<count($timeVisits);$i++){
					echo '<tr><td>'.$timeVisits[$i].'</td>';
					for($j=0;$j<count($farms);$j++){
						echo '<td style="">';
						customer($infoDetails[$stt]);
						$stt++;
						echo '</td>';
					}
					echo '</tr>';
				}
				echo ' </tbody> </table>';
			}
			function customer($data){
				echo "<div style='    display: flex;'>";
				foreach ($data as $key) {
					$name=$key['name'];
					$phone=$key['phone'];
					$nameHorse=$key['Horse'];
					echo "<div style='background:black; margin:3px; padding: 5px; border-radius:5px'>
					$name <br>
					$phone <br>
					$nameHorse
					</div>";
				}
				echo "</div>";
			}
			?>

		</div>
	</div>
</body>
</html>