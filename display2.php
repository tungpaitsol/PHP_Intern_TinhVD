<?php
session_start();
include ("./processing.php");
//print_r($_POST['nameHorse']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>USER</title>
	<style type="text/css">
	</style>
</head>
<body>
	<form action="" method="POST">
		<div class="form-group">
			<label for="exampleFormControlSelect1">Chọn ngày thăm ngựa:</label>
			<select class="form-control" name="selectDate" id="selectDate" onchange="this.form.submit()">
				<?php 
				if(!isset($_POST['selectDate'])){
					echo "<option >---Select Date---</option>";
				}
				foreach (selectDay($dateStartSelect,$daySelect) as $date) {
					$dateSelect="";
					if(isset($_POST['selectDate'])&&$_POST['selectDate']==$date){
						$dateSelect="selected";
					}
					echo "<option value=".$date." $dateSelect >".$date."</option>";
				}
				?>
			</select>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col">Nông trại</th>
					<th scope="col">Thời gian thăm</th>
					<th scope="col">Tên ngựa</th>
				</tr>
			</thead>
			<tbody>				
				<?php
				if (isset($_POST['addrow'])) {
					$row=$_SESSION['row'];
					$row++;
					$_SESSION["row"]=$row;
				}
				if(!isset($_POST['ranchId'])){
					$_SESSION['ranchId']="";
				}
				$_SESSION['dataUserRegister']=[];
				if(isset($_POST['selectDate']) && $_POST['selectDate']!=$_SESSION['dateSelect']){
					$_SESSION['dateSelect']=$_POST['selectDate'];
					$_SESSION["row"]=0;
					$_SESSION['time_of_day']=[];
				}
				for($i=0;$i<$_SESSION['row'];$i++){
					$numberHorse=0;
					if(!empty($_POST['timeOfDay'][$i])&& !empty($_POST['timeOfDay'][$i])){
						if(!empty($_SESSION['ranchId'][$i])&&$_SESSION['ranchId'][$i]==$_POST['ranchId'][$i]){
							$numberHorse=getNumberHorse($_POST['ranchId'][$i],$_POST['timeOfDay'][$i],$_POST['selectDate'],$conn)['number_horse'];
							$checkbox=getNumberHorse($_POST['ranchId'][$i],$_POST['timeOfDay'][$i],$_POST['selectDate'],$conn)['check'];
							$checkBox="";
							if(!$checkbox){
								$checkBox="disabled";
							}
							$_SESSION['time_of_day'][$_POST['ranchId'][$i]][$i]=$_POST['timeOfDay'][$i];
						}
					}
					echo '<tr>
					<td>
					<select name="ranchId[]" onchange="this.form.submit()">';
					if(!isset($_POST['ranchId'][$i])){
						echo "<option >---Select Ranch---</option>";
					}
					foreach ($ranchIds as $ranchId) {
						$check="";
						if(isset($_POST['ranchId'])&&$_POST['ranchId'][$i]==$ranchId['id_ranch_calendar']){
							$nameRanch=$ranchId['ranch_id'];
							$check="selected";
						}
						echo "<option value=".$ranchId['id_ranch_calendar']." $check>".$ranchId['ranch_id']."</option>";
					}
					echo '</select></td>';
					$objAdminRegister=[];
					if(isset($_POST['ranchId'][$i]) && $_POST['ranchId'][$i]!=False)
					{
						$idRanchCalendar=$_POST['ranchId'][$i];
						$stmt=$conn->prepare("SELECT * FROM ranch_calendar_info WHERE ranch_calendar_id =:id");
						$stmt->setFetchMode(PDO::FETCH_CLASS,'AdminRegister');
						$stmt->execute(["id"=>$idRanchCalendar]);
						$objAdminRegister=$stmt->fetchAll();
					}
					echo '<td><select name="timeOfDay[]" onchange="this.form.submit()">';
					if(!empty($_SESSION['ranchId'][$i])&&!empty($_POST['timeOfDay'][$i]) && $_SESSION['ranchId'][$i]==$_POST['ranchId'][$i]){
						echo "<option value=".$_POST['timeOfDay'][$i].">".$_POST['timeOfDay'][$i]."</option>";
					}
					else{
						echo "<option >---Select Date---</option>";
					}
					foreach ($objAdminRegister as $timeOfDay) {
						$dis="";
						if(!isset($_POST['ranchId'][$i])) continue;
						$nameHorseTime=getNumberHorse($_POST['ranchId'][$i],$timeOfDay->getTimeOfDay(),$_POST['selectDate'],$conn)['number_horse'];
						if(!empty($_SESSION['time_of_day'][$_POST['ranchId'][$i]])&&in_array($timeOfDay->getTimeOfDay(),$_SESSION['time_of_day'][$_POST['ranchId'][$i]]) )
						{
							$dis="disabled";
						}
						if($timeOfDay->getTimeOfDay()!=$_POST['timeOfDay'][$i]){
							echo "<option value=".$timeOfDay->getTimeOfDay()." $dis >".$timeOfDay->getTimeOfDay()." [$nameHorseTime]</option>";
						}
					}
					echo '</select></td><td style="display: inline-grid;">';
					if(!empty($_POST['timeOfDay'][$i])&&!empty($_SESSION['ranchId'][$i])&&!empty($_POST['ranchId'][$i])&&$_SESSION['ranchId'][$i]==$_POST['ranchId'][$i]){
						for($j=0;$j<$numberHorse;$j++){
							$nameHorse="";
							if(isset($_POST['nameHorse'][$i][$j])){
								$nameHorse=$_POST["nameHorse"][$i][$j];
							}
							echo '<input type="text"  value="'.$nameHorse.'" name="nameHorse['.$i.'][]" onchange="this.form.submit()">';
						}
						$visit_other_club="";
						if(!isset($_SESSION['time_of_day'][$i])){
							$_SESSION['time_of_day'][$i]="";
						}
						if(isset($_POST["visit_other_club"][$i])){
							if($_POST["visit_other_club"][$i]>$numberHorse-checkInputNameHorse($_POST['nameHorse'][$i])){
								alert("Số ngựa phải nhỏ hơn $numberHorse");
							}
							else{
								$visit_other_club=$_POST["visit_other_club"][$i];
							}
						}
						echo "<lable>Thêm ngựa:<input type='number' name='visit_other_club[$i]' $checkBox onchange='this.form.submit()' value='$visit_other_club'></lable>";
						echo '</td></tr>';
					}
					if(isset($_POST['nameHorse'][$i]) && isset($_POST['timeOfDay'][$i])){
						$horseOtherClub=0;
						if(isset($_POST['visit_other_club'])&&$_POST['visit_other_club']!=""){
							$horseOtherClub=$_POST['visit_other_club'][$i];
						}
						$_SESSION['dataUserRegister'][$i]=["dateVisit"=>$_POST['selectDate'],"nameRanch"=>$nameRanch,"time_of_day"=>$_POST['timeOfDay'][$i],"nameHorse"=>$_POST['nameHorse'][$i],"visit_other_club"=>$horseOtherClub];
					}
					if(!empty($_POST['timeOfDay'][$i])&&!empty($_SESSION['ranchId'][$i])&&$_SESSION['ranchId'][$i]!=$_POST['ranchId'][$i]){
						unset($_SESSION['time_of_day'][$_POST['ranchId'][$i]][$i],$_SESSION['time_of_day']);
					}
					if(!empty($_POST['ranchId'][$i])){
						$_SESSION['ranchId'][$i]=$_POST['ranchId'][$i];
					}
				}
				?>
			</tbody>
		</table>
		<div style="margin: 15px 0"><button type="submit" name="addrow" >ADD RANCH</button></div>
		<button type="submit" class="btn btn-dark" name="before">Before</button>
		<button type="submit" class="btn btn-primary" name="confirm">Confirm</button>
	</form>
</body>
</html>