<?php
include ("./oopclass.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$timeCurent= date("H:i:s");
$mktime1= "17:30:00";
$mktime2= "09:00:00";
$dateStartSelect=date('Y-m-d');
if((strtotime($timeCurent)-strtotime($mktime1))>0){
	$dateStartSelect=date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
}
$daySelect=6;
if((strtotime($timeCurent)-strtotime($mktime2))>0&&(strtotime($timeCurent)-strtotime($mktime1))<0){
	$daySelect=7;
}
function selectDay($dateStartSelect,$daySelect){
	$dateSelect=[];
	for($i=0;$i<$daySelect;$i++){
		array_push($dateSelect,date('Y-m-d',mktime(0, 0, 0, date("m",strtotime($dateStartSelect))  , date("d",strtotime($dateStartSelect))+$i+8, date("Y",strtotime($dateStartSelect)))));
	}
	return $dateSelect;
}
function convertDateToWeekday($date){
	return getDate(strtotime($date))['weekday'];
}
function getRecordHaveTime($ranchCalendarId,$hour,$conn){
	$stmt=$conn->prepare("SELECT * FROM ranch_calendar_info WHERE time_of_day=:hour AND ranch_calendar_id=:id");
	$stmt->setFetchMode(PDO::FETCH_CLASS,'AdminRegister');
	$stmt->execute(["id"=>$ranchCalendarId,":hour"=>$hour]);
	return $stmt->fetch();
}
function getNumberHorse($ranchCalendarId,$hour,$date,$conn){
	$bigHolidays=$conn->prepare("SELECT date_holiday FROM holiday");
	$bigHolidays->execute();
	$bigHolidays->setFetchMode(PDO::FETCH_ASSOC);
	$bigHolidays=$bigHolidays->fetchAll();
	$bigHolidays=array_column($bigHolidays, 'date_holiday');
	$record=getRecordHaveTime($ranchCalendarId,$hour,$conn);
	$weekDay=convertDateToWeekday($date);
	if(in_array($date,$bigHolidays)){
		$numberHorseVisit =$record->getHorseHoliday();
		$checked=$record->getOtherHoliday();
		return ['number_horse'=>$numberHorseVisit,'check'=>$checked];
	}
	if($weekDay=="Monday") {
		$numberHorseVisit =$record->getHorseMon();
		$checked=$record->getOtherMon();
		return ['number_horse'=>$numberHorseVisit,'check'=>$checked];
	}
	if($weekDay=="Tuesday") {
		$numberHorseVisit=$record->getHorseTue();
		$checked=$record->getOtherTue();
		return ['number_horse'=>$numberHorseVisit,'check'=>$checked];
	}
	if($weekDay=="Wednesday") {
		$numberHorseVisit =$record->getHorseWed();
		$checked=$record->getOtherWed();
		return ['number_horse'=>$numberHorseVisit,'check'=>$checked];
	}
	if($weekDay=="Thursday") {
		$numberHorseVisit =$record->getHorseThu();
		$checked=$record->getOtherThu();
		return ['number_horse'=>$numberHorseVisit,'check'=>$checked];
	}
	if($weekDay=="Friday") {
		$numberHorseVisit =$record->getHorseFri();
		$checked=$record->getOtherFri();
		return ['number_horse'=>$numberHorseVisit,'check'=>$checked];
	}
	if($weekDay=="Saturday") {
		$numberHorseVisit =$record->getHorseSat();
		$checked=$record->getOtherSat();
		return ['number_horse'=>$numberHorseVisit,'check'=>$checked];
	}
	if($weekDay=="Sunday") {
		$numberHorseVisit =$record->getHorseSun();
		$checked=$record->getOtherHoliday();
		return ['number_horse'=>$numberHorseVisit,'check'=>$checked];
	}
}
if(isset($_POST['next']) || isset($_POST['addrow'])){
	$dateChoice=$_POST['selectDate'];
	$ranchInfo=$caculatorSelect->selectRanch($dateChoice, $objRanchCalendar);
}
$row=0;
if (empty($_SESSION['row'])) {
	$_SESSION['row']=$row;
}
if(isset($_POST['before']) ){
	session_destroy();
	echo '<script>window.location="./display2.php"</script>';
}
if(isset($_POST['confirm']) ){
	echo "<script>window.location='./userRegister.php';</script>";
}
if(isset($_POST['selectDate'])){
	$dateChoice=$_POST['selectDate'];
	$ranchIds=$caculatorSelect->selectRanch($dateChoice, $objRanchCalendar);
}
if(!isset($_SESSION['dateSelect'])){
	$_SESSION['dateSelect']="";
}
function alert($string){
	echo '<script>alert("'.$string.'");</script>';
}
function checkInputNameHorse($nameHorses){
	$numberHorse=0;
	foreach ($nameHorses as $nameHorse) {
		if($nameHorse!=""){
			$numberHorse++;
		}
	}
	return $numberHorse;
}
?>