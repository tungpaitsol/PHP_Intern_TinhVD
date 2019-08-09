<?php
include ("./oopclass.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ADMIN REGISTER</title>
</head>
<body>
	<form method="POST">
		<div class="form-group">
			<label for="exampleFormControlSelect1">Ranch code</label>
			<select class="form-control" name="ranchId">
				<?php
				foreach ($objRanchs as $value) {
					echo '<option value="'.$value->getRanchId().'">'.$value->getNameRanch().'</option>';
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleFormControlInput1">Tour start date</label>
			<input type="text" class="form-control" name="startDate"  placeholder="2019-07-22">
		</div>
		<div class="form-group">
			<label for="exampleFormControlInput1">Tour end date</label>
			<input type="text" class="form-control" name="endDate"  placeholder="2020-07-22">
		</div>
		<div>
			<table class="table table-bordered ">
				<thead>
					<tr>
						<th scope="col">Time of day</th>
						<th scope="col">Number of reception groups</th>
						<th scope="col">Moon</th>
						<th scope="col">Fire</th>
						<th scope="col">Water</th>
						<th scope="col">Wood</th>
						<th scope="col">Money</th>
						<th scope="col">Soil</th>
						<th scope="col">Day</th>
						<th scope="col">Public Holiday</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
		<div>
			<button type="button" class="btn btn-primary" style="margin-bottom: 1%" onclick="insert()">+</button>
		</div>
		<div>
			<input type="submit" class="btn btn-primary" value="submit" name="submit">
		</div>
	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		var i=0;
		function insert(){
			$('tbody').append('<tr class="tr'+i+'"><td><input type="number" min="1" class="form-control" name="ipTime['+i+']"></td><td><input type="number" min="1" class="form-control" name="group['+i+']"></td><td><input type="number" min="1" class="form-control" name="moon['+i+']"><div class="form-check"><input type="hidden" value="0" name="check_moon['+i+']" class="form-check-input"><input class="form-check-input" name="check_moon['+i+']" type="checkbox" value="1"><label class="form-check-label" >other club</label></div></td><td><input type="number" min="1" class="form-control" name="fire['+i+']"><div class="form-check"><input type="hidden" value="0" name="check_fire['+i+']" class="form-check-input"><input class="form-check-input" type="checkbox" name="check_fire['+i+']" value="1"><label class="form-check-label">other club</label></div></td><td><input type="number" min="1" class="form-control" name="water['+i+']"><div class="form-check"><input type="hidden" value="0" name="check_water['+i+']" class="form-check-input"><input class="form-check-input" type="checkbox" name="check_water['+i+']" value="1"><label class="form-check-label">other club</label></div></td><td><input type="number" min="1" class="form-control" name="wood['+i+']"><div class="form-check"><input type="hidden" value="0" name="check_wood['+i+']" class="form-check-input"><input class="form-check-input" type="checkbox" name="check_wood['+i+']" value="1"><label class="form-check-label">other club</label></div></td><td><input type="number" min="1" class="form-control" name="money['+i+']"><div class="form-check"><input type="hidden" value="0" name="check_money['+i+']" class="form-check-input"><input class="form-check-input" type="checkbox" name="check_money['+i+']" value="1"><label class="form-check-label">other club</label></div></td><td><input type="number" min="1" class="form-control" name="soil['+i+']"><div class="form-check"><input type="hidden" value="0" name="check_soil['+i+']" class="form-check-input"><input class="form-check-input" type="checkbox" name="check_soil['+i+']" value="1"><label class="form-check-label">other club</label></div></td><td><input type="number" min="1" class="form-control" name="day['+i+']"><div class="form-check"><input type="hidden" value="0" name="check_day['+i+']" class="form-check-input"><input class="form-check-input" type="checkbox" name="check_day['+i+']" value="1"><label class="form-check-label">other club</label></div></td><td><input type="number" min="1" class="form-control" name="publicHoliday['+i+']"><div class="form-check"><input type="hidden" value="0" name="check_publicHoliday['+i+']" class="form-check-input"><input class="form-check-input" type="checkbox" name="check_publicHoliday['+i+']" value="1"><label class="form-check-label">other club</label></div></td><td><button type="button" class="btn btn-danger" value="tr'+i+'" onclick="deleterow(this.value)">Delete</button></td></tr>');
			i++;
		}
		function deleterow(c){
			$('.'+c).empty().html('');

		}
		function getValue(){
			var values = {};
			values= $("#ip1").serialize().val();
			console.log(values);
		}
	</script>
	<?php
	function formartDate($input){
		return date("Y-m-d",strtotime($input));
	}
	if(isset($_POST["submit"])){
		$ranchId=$_POST['ranchId'];
		$startDate=$_POST['startDate'];
		$endDate=$_POST['endDate'];
		$times=$_POST['ipTime'];
		$groups=$_POST['group'];
		$moons=$_POST['moon'];
		$fires=$_POST['fire'];
		$waters=$_POST['water'];
		$woods=$_POST['wood'];
		$moneys=$_POST['money'];
		$soils=$_POST['soil'];
		$days=$_POST['day'];
		$publicHolidays=$_POST['publicHoliday'];
		$checkMoons=$_POST['check_moon'];
		$checkFires=$_POST['check_fire'];
		$checkWaters=$_POST['check_water'];
		$checkWoods=$_POST['check_wood'];
		$checkMoneys=$_POST['check_money'];
		$checkSoils=$_POST['check_soil'];
		$checkDays=$_POST['check_day'];
		$checkPublicHolidays=$_POST['check_publicHoliday'];
		$ranchCalendarId=insertRanchCalendar($ranchId,$startDate,$endDate,$conn);
		foreach ($times as $keyTime => $time) {
			$time=$time."00";
			insertRanchCalendarInfo($ranchCalendarId,$time,$groups[$keyTime],$moons[$keyTime],$fires[$keyTime],$waters[$keyTime],$woods[$keyTime],$moneys[$keyTime],$soils[$keyTime],$days[$keyTime],$publicHolidays[$keyTime],$checkMoons[$keyTime],$checkFires[$keyTime],$checkWaters[$keyTime],$checkWoods[$keyTime],$checkMoneys[$keyTime],$checkSoils[$keyTime],$checkDays[$keyTime],$checkPublicHolidays[$keyTime],$conn);
		}

	}
	function insertRanchCalendar($ranchId,$startDate,$endDate,$conn){
		$sqlInsert = $conn->prepare('INSERT INTO ranch_calendar (id, ranch_id, start_date, end_date) values (?, ?, ?, ?)');
		$data = array('', $ranchId, $startDate,$endDate);
		$sqlInsert->execute($data);
		$sqlSelect = $conn->prepare('SELECT id FROM ranch_calendar ORDER BY id DESC LIMIT 1');
		$sqlSelect->execute();
		return $sqlSelect->fetch()['id'];
	}
	function insertRanchCalendarInfo($ranchCalendarId, $timeOfDay,$groupReception,$mondayNumberHorse,$tuesdayNumberHorse,$wednesdayNumberHorse,$thursdayNumberHorse,$fridayNumberHorse,$saturdayNumberHorse,$sundayNumberHorse,$holidayNumberHorse,$mondayOtherClub,$tuesdayOtherClub,$wednesdayOtherClub,$thursdayOtherClub,$fridayOtherClub,$saturdayOtherClub,$sundayOtherClub,$holidayOtherClub,$conn){
		$sqlInsert = $conn->prepare('INSERT INTO ranch_calendar_info (id, ranch_calendar_id, time_of_day, group_reception, monday_number_horse, tuesday_number_horse, wednesday_number_horse, thursday_number_horse, friday_number_horse, saturday_number_horse, sunday_number_horse,holiday_number_horse,monday_other_club,tuesday_other_club,	wednesday_other_club,thursday_other_club,friday_other_club,saturday_other_club,	sunday_other_club,	holiday_other_club ) values (?, ?, ?, ?,?, ?, ?, ?,?, ?, ?, ?,?, ?, ?, ?,?, ?, ?, ?)');
		$data = array('', $ranchCalendarId, $timeOfDay,$groupReception,$mondayNumberHorse,$tuesdayNumberHorse,$wednesdayNumberHorse,$thursdayNumberHorse,$fridayNumberHorse,$saturdayNumberHorse,$sundayNumberHorse,$holidayNumberHorse,$mondayOtherClub,$tuesdayOtherClub,$wednesdayOtherClub,$thursdayOtherClub,$fridayOtherClub,$saturdayOtherClub,$sundayOtherClub,$holidayOtherClub);
		$sqlInsert->execute($data);
	}
	?>
</body>
</html>