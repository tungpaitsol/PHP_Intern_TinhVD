<?php
/*---------ngay nhan bai tap 10/6---------*/

/*---------ngay update          ----------*/
$file= include("./data.php");
class Employees
{
	private $code;
	private $full_name;
	private $age;
	private $gender;
	private $marital_status;
	private $total_work_time;
	private $salary;
	private $workdays;
	private $start_work_time;
	private $workhour;
	private $has_lunch_break;
	public function __construct($_code, $_full_name, $_age,$_gender, $_marital_status,$_total_work_time = 0  ,$_salary,$_workdays = 0,$_start_work_time , $_workhour, $_has_lunch_break )
	{
		$this->code = $_code;
		$this->full_name = $_full_name;
		$this->age = $_age;
		$this->gender = $_gender;
		$this->marital_status = $_marital_status;
		$this->total_work_time = $_total_work_time;
		$this->salary = $_salary;
		$this->start_work_time = $_start_work_time;
		$this->workdays = $_workdays;
		$this->workhour = $_workhour;
		$this->has_lunch_break = $_has_lunch_break;
	}
	public function getCode()
	{
		return $this->code;
	}
	public function getFullName()
	{
		return $this->full_name;
	}
	public function getAge()
	{
		return $this->age;
	}
	public function getGender()
	{
		return $this->gender;
	}
	public function getMaritalStatus()
	{
		return $this->marital_status;
	}
	public function getTotalWorkTime()
	{
		return $this->total_work_time;
	}
	public function getSalary()
	{
		return $this->salary;
	}
	public function getStartWorkTime()
	{
		return $this->start_work_time;
	}
	public function getWorkdays()
	{
		return $this->workdays;
	}
	public function getWorkhour()
	{
		return $this->workhour;
	}
	public function getHasLunchBreak()
	{
		return $this->has_lunch_break;
	}
}
//============ 
class ListWorkTime
{
	private $member_code;
	private $start_datetime;
	private $end_datetime;
	public function __construct($_member_code, $_start_datetime, $_end_datetime)
	{
		$this->member_code = $_member_code;
		$this->start_datetime = $_start_datetime;
		$this->end_datetime = $_end_datetime;
	}
	public function getMemberCode()
	{
		return $this->member_code;
	}
	public function getStartDatetime()
	{
		return $this->start_datetime;
	}
	public function getEndDatetime()
	{
		return $this->end_datetime;
	}
}
$listworktime=[];
$worktime = array();
for($i=0; $i<count($listWorkTime); $i++){
	array_push($listworktime, new ListWorkTime($listWorkTime[$i]['member_code'],$listWorkTime[$i]['start_datetime'],$listWorkTime[$i]['end_datetime']));
}
class General{
	function dateInMonth($year, $month){ // ham tinh so ngay trong thang
		$day=0;
		if($year%4==0 &&$month==2){
			return $day=29;
		}
		else if($year%4!=0 &&$month==2){
			return $day=28;
		}
		if($month<=12){
			if ($month==1||$month==3||$month==5||$month==7||$month==8||$month==10||$month==12){
				return $day=31;
			}
			else{
				return $day=30;
			}
		}
		return false;

	}
//========ham tra lai ngay nghi
function third($date){ // chen vao thoi gian "y:m:d"
$arDate= getdate(strtotime($date));
if($arDate["weekday"]=="Sunday" ||$arDate["weekday"]=="Saturday" ){
	return true;
}
return false;

}
//==========ham tinh so ngay
function dayWorkInMonth($date){ // chen vao thoi gian "y:m:d" or "y:m" "y:m:d h:i:s" 
$arDate= getdate(strtotime($date));
$y=$arDate["year"];
$m=$arDate["mon"];
	$holidays = ["1-1", "2-4", "2-5", "2-6", "2-7", "2-8", "4-14", "4-30", "5-1", "9-2"]; //month-day
	$holiday=0;
	$d=General::dateInMonth($y,$m);
	$holiday=0;
	for($i=1;$i<$d+1;$i++){
		$day=$y."-".$m."-".$i;
		$da=$m."-".$i;
		if(General::third($day) || in_array($da,$holidays)){
			$holiday++;
		}
	}
	return $d-$holiday;
}
//===============
function getTime($data){ // lay ra gio : phut : giay cua ngay neu ngay do truyen vao co ca ngay, thang nam
	//
	$h=date("H",strtotime($data));
	$i=date("i",strtotime($data));
	$s=date("s",strtotime($data));
	$time=$h.":".$i.":".$s;
	return $time;
}
function hourWorkDay($a,$b){ //ham tinh so gio lam trong 1 ngay
	//a la thoi gian bat dau, b la thoi gian ket thuc
	$a=General::getTime($a);
	$b=General::getTime($b);
	$H= (date("H",strtotime($b)-strtotime($a)))-1;
	$I=(date("i",strtotime($b)-strtotime($a)));
	return $H+$I/60;
}
function getMemberCode($data){
	//mang dua vao la list work full (Part)time
	$ar_code=[]; 
	foreach ($data as $key) {
		array_push($ar_code, $key['code']);
	}
	return $ar_code; 
}
function listWorkTimeF($listWorkTime,$listMemberFullTime,$dataDate){
	$arDate= getdate(strtotime($dataDate));
	$m=$arDate["mon"];
	$ar_code=General::getMemberCode($listMemberFullTime); //lay ra ma code cua member full time
	$aa=0;
	$ar_code_key=[];
	$ar_member=[];
	foreach ($ar_code as $key1) {
		$i=0;
		foreach ($listWorkTime as $key) {
			if($key["member_code"]==$key1){
				$ar_code_key[$key1][$i]=$i;
			}
			$i++;
		}
	}
	foreach ($listMemberFullTime as $key ) {
		//ma code $key["code"]
		//so thoi gian de tinh 1 cong $key['work_hour']
		$day=0;
		$worktime=$key['start_work_time'];//gio dang ky lam
		foreach ($ar_code_key[$key["code"]] as $key1) {
			$arDate2= getdate(strtotime($listWorkTime[$key1]["start_datetime"]));
			$m2=$arDate2["mon"];
			if($m==$m2){
				$time2=General::getTime($listWorkTime[$key1]["start_datetime"]); //gio bat dau den lam
			$time3=General::getTime($listWorkTime[$key1]["end_datetime"]); //gio ra ve
			
			if (strtotime($worktime)-strtotime($time2)<0){ //di muon
				$t_s=$time2;
				$time=General::hourWorkDay($time2,$time3)-1.5;
			}
			else{ // di som
				$t_s=$worktime;
				$time=General::hourWorkDay($worktime,$time3)-1.5;
			}
			if($time>=$key['work_hour']){
				$day+=1;
			}
			elseif($time>=4||$time<$key['work_hour']){
				$day+=0.5;
			}
		}

	}
	$ar_member[$aa]=["code"=>$key["code"],"workdays"=>$day];
	$aa++;
}
return $ar_member;
}
//=============================================
function listWorkTimeP($listWorkTime,$listMemberPartTime,$dataDate){
	$arDate= getdate(strtotime($dataDate));
	$m=$arDate["mon"];
	$ar_code=General::getMemberCode($listMemberPartTime); //lay ra ma code cua member part time
	$aa=0;
	$ar_code_key=[];
	$ar_member=[];
	foreach ($ar_code as $key1) {
		$i=0;
		foreach ($listWorkTime as $key) {
			if($key["member_code"]==$key1){
				$ar_code_key[$key1][$i]=$i;	
			}
			$i++;
		}
	}
	foreach ($listMemberPartTime as $key ) {
		$day=0;
		$worktime=$key['start_work_time'];//gio dang ky lam
		foreach ($ar_code_key[$key["code"]] as $key1) {
			$arDate2= getdate(strtotime($listWorkTime[$key1]["start_datetime"]));
			$m2=$arDate2["mon"];
			if($m==$m2){
			$time2=General::getTime($listWorkTime[$key1]["start_datetime"]); //gio bat dau den lam
			$time3=General::getTime($listWorkTime[$key1]["end_datetime"]); //gio ra ve
			if (strtotime($worktime)-strtotime($time2)<0){ //di muon
				$time=General::hourWorkDay($time2,$time3);
			}
			else{ // di som
				$time=General::hourWorkDay($worktime,$time3);
			}
			if($time>=$key['work_hour']){
				$day+=0.5;
			}
		}
	}
	$ar_member[$aa]=["code"=>$key["code"],"workdays"=>$day];
	$aa++;
}
return $ar_member;
}
//===============
function moneyInMonthF($typeWorkTime, $listWorkTime,$date){
	$ar_work_time=$typeWorkTime;
	$ar= General::listWorkTimeF($listWorkTime,$typeWorkTime,$date);
	$i=0;
	foreach ($typeWorkTime as $key) {
		$workdays= $ar[$i]["workdays"];
		$salary=$workdays*($key['salary']/General::dayWorkInMonth($date));
		$ar_work_time[$i]["workdays"]=$workdays;
		$ar_work_time[$i]["salary"]=$salary;
		$i++;
	}
	return $ar_work_time;
}
function moneyInMonthP($typeWorkTime, $listWorkTime,$date){
	$ar_work_time=$typeWorkTime;
	$ar= General::listWorkTimeP($listWorkTime,$typeWorkTime,$date);
	$i=0;
	foreach ($typeWorkTime as $key) {
		$workdays= $ar[$i]["workdays"];
		$salary=$workdays*($key['salary']/General::dayWorkInMonth($date));
		$ar_work_time[$i]["workdays"]=$workdays;
		$ar_work_time[$i]["salary"]=$salary;
		$i++;
	}
	return $ar_work_time;
}
}
$ar_full_time=General::moneyInMonthF($listMemberFullTime, $listWorkTime,"2019-04");
$ar_part_time=General::moneyInMonthP($listMemberPartTime, $listWorkTime,"2019-04");
$memberFullTime=[];
foreach ($ar_full_time as $key) {
	array_push($memberFullTime,new Employees($key["code"],$key["full_name"],$key["age"],$key["gender"],$key["marital_status"],$key["total_work_time"],$key["salary"],$key["workdays"],$key["start_work_time"],$key["work_hour"],$key["has_lunch_break"]));
}
$memberPartTime=[];
foreach ($ar_part_time as $key) {
	array_push($memberPartTime,new Employees($key["code"],$key["full_name"],$key["age"],$key["gender"],$key["marital_status"],$key["total_work_time"],$key["salary"],$key["workdays"],$key["start_work_time"],$key["work_hour"],$key["has_lunch_break"]));
}
print_r($memberFullTime);
print_r($memberPartTime);
?>
