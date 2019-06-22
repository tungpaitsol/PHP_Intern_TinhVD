<?php
/*Ngày giao bài 10/6 update 22/6*/
$file = include("./data.php");
class Employee
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
	private $work_hour;
	private $has_lunch_break;
	public function __construct($_code, $_full_name, $_age, $_gender, $_marital_status, $_total_work_time, $_salary,$_start_work_time, $_work_hour, $_has_lunch_break, $_workdays=0)
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
		$this->work_hour = $_work_hour;
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
	public function setSalary($salary)
	{
		$this->salary=$salary;
	}
	public function getSalary()
	{
		return $this->salary;
	}
	public function getStartWorkTime()
	{
		return $this->start_work_time;
	}
	public function setWorkdays($wd)
	{
		$this->workdays=$wd;
	}
	public function getWorkdays()
	{
		return $this->workdays;
	}
	public function getWorkhour()
	{
		return $this->work_hour;
	}
	public function getHasLunchBreak()
	{
		return $this->has_lunch_break;
	}
}
//============
class worktime{
	private $member_code;
	private $start_datetime;
	private $end_datetime;
	function __construct($_member_code,$_start_datetime,$_end_datetime){
		$this->member_code=$_member_code;
		$this->start_datetime=$_start_datetime;
		$this->end_datetime=$_end_datetime;
	}
	function getMember_code(){
		return $this->member_code;
	}
	function getStartTime(){
		return $this->start_datetime;
	}
	function getEndTime(){
		return $this->end_datetime;
	}
}
$array_work_time=[];
foreach ($listWorkTime as $key) {
	array_push($array_work_time, new worktime($key["member_code"],$key["start_datetime"],$key["end_datetime"]));
}
$array_employee_full_time=[];
foreach ($listMemberFullTime as $key) {
	array_push($array_employee_full_time, new Employee($key["code"],$key["full_name"],$key["age"],$key["gender"],$key["marital_status"],$key["total_work_time"],$key["salary"],$key["start_work_time"],$key["work_hour"],$key["has_lunch_break"]));
}
$array_employee_part_time=[];
foreach ($listMemberPartTime as $key) {
	array_push($array_employee_part_time, new Employee($key["code"],$key["full_name"],$key["age"],$key["gender"],$key["marital_status"],$key["total_work_time"],$key["salary"],$key["start_work_time"],$key["work_hour"],$key["has_lunch_break"]));
}
/*-------------------------------------*/
class General
{
	function dateInMonth($year,$month)
	{
		return cal_days_in_month(CAL_GREGORIAN, $month, $year);
	}
//========ham tra lai ngay nghi
	function third($date)
    { // chen vao thoi gian "y:m:d"
    $arDate = getdate(strtotime($date));
    if ($arDate["weekday"] == "Sunday" || $arDate["weekday"] == "Saturday") {
    	return true;
    }
    return false;
}
//==========ham tinh so ngay
function dayWorkInMonth($date) 
    { // chen vao thoi gian "y:m:d" or "y:m" "y:m:d h:i:s"
    $arDate = getdate(strtotime($date));
    $y = $arDate["year"];
    $m = $arDate["mon"];
        $holidays = ["1-1", "2-4", "2-5", "2-6", "2-7", "2-8", "4-14", "4-30", "5-1", "9-2"]; //month-day
        $holiday = 0;
        $d = $this->dateInMonth($y, $m);
        $holiday = 0;
        for ($i = 1; $i <= $d; $i++) {
        	$day = $y . "-" . $m . "-" . $i;
        	$da = $m . "-" . $i;
        	if ($this->third($day) || in_array($da, $holidays)) {
        		$holiday++;
        	}
        }
        return $d - $holiday;
    }
//===============
    function getTime($data)
    { // lay ra gio : phut : giay cua ngay neu ngay do truyen vao co ca ngay, thang nam
    	return date('H:i:s', strtotime($data));
    }
    function hourWorkDay($a, $b)
    { //ham tinh so gio lam trong 1 ngay
        //a la thoi gian bat dau, b la thoi gian ket thuc
    	$a= $this->getTime($a);
    	$b = $this->getTime($b);
    	return (strtotime($b) - strtotime($a))/3600;
    }
    function listWorkTimeF($listWorkTime, $listMemberFullTime, $dataDate)
    {
    	$arDate = getdate(strtotime($dataDate));
    	$m = $arDate["mon"];
    	foreach ($listMemberFullTime as $key ) {
    		$day = 0;
    		foreach ($listWorkTime as $item) {
    			if($key->getCode()==$item->getMember_code()){        			
        			$worktime = $key->getStartWorkTime();//gio dang ky lam
        			$time2 = $this->getTime($item->getStartTime()); //gio bat dau den lam
                    $time3 = $this->getTime($item->getEndTime()); //gio ra ve
                    if (strtotime($worktime) - strtotime($time2) < 0) { //di muon
                    	$t_s = $time2;
                    	$time = $this->hourWorkDay($time2, $time3) - 1.5;
                    } else { // di som
                    	$t_s = $worktime;
                    	$time = $this->hourWorkDay($worktime, $time3) - 1.5;
                    }
                    if ($time >= $key->getWorkhour()) {
                    	$day += 1;
                    } elseif ($time >= 4 || $time < $key->getWorkhour()) {
                    	$day += 0.5;
                    }
                }
            }
            $key->setWorkdays($day);
        }
        
        
    }

//=============================================
    function listWorkTimeP($listWorkTime, $listMemberFullTime, $dataDate)
    {
    	$arDate = getdate(strtotime($dataDate));
    	$m = $arDate["mon"];
    	foreach ($listMemberFullTime as $key ) {
    		$day = 0;
    		foreach ($listWorkTime as $item) {
    			if($key->getCode()==$item->getMember_code()){        			
        			$worktime = $key->getStartWorkTime();//gio dang ky lam
        			$time2 = $this->getTime($item->getStartTime()); //gio bat dau den lam
                    $time3 = $this->getTime($item->getEndTime()); //gio ra ve
                    if (strtotime($worktime) - strtotime($time2) < 0) { //di muon
                    	$time = $this->hourWorkDay($time2, $time3);
                    } else { // di som
                    	$time = $this->hourWorkDay($worktime, $time3);
                    }
                    if ($time >= $key->getWorkhour()) {
                    	$day += 0.5;
                    }
                }
            }
            $key->setWorkdays($day);
        }
    }
//===============
    function moneyInMonthF($employees, $date)
    {
    	foreach ($employees as $key ) {
    		$salary=$key->getSalary();
    		$workdays=$key->getWorkdays();
    		$salary = $workdays * ($salary / $this->dayWorkInMonth($date));
    		$key->setSalary($salary);
    	}
    }
}
/*-------------------------------------*/
$gender= new General;
$gender->listWorkTimeF($array_work_time, $array_employee_full_time, "2019-04");
$gender->listWorkTimeP($array_work_time, $array_employee_part_time, "2019-04");
$gender->moneyInMonthF($array_employee_full_time, "2019-04");
$gender->moneyInMonthF($array_employee_part_time, "2019-04");
print_r($array_employee_full_time);
print_r($array_employee_part_time);
?>
