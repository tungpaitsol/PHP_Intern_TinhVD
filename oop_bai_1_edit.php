<?php
$file = include("./data.php");
class Employee
{
	private $_code;
	private $_fullName;
	private $_age;
	private $_gender;
	private $_maritalStatus;
	private $_totalWorkTime;
	private $_salary;
	private $_workDays;
	private $_startWorkTime;
	private $_workHour;
	private $_hasLunchBreak;
	private $_salaryActual;
	public function __construct($code, $fullName, $age, $gender, $maritalStatus, $totalWorkTime,
		$salary,$startWorkTime, $workHour, $hasLunchBreak, $workDays=0,$salaryActual=0)
	{
		$this->_code = $code;
		$this->_fullName = $fullName;
		$this->_age = $age;
		$this->_gender = $gender;
		$this->_maritalStatus = $maritalStatus;
		$this->_totalWorkTime = $totalWorkTime;
		$this->_salary = $salary;
		$this->_startWorkTime = $startWorkTime;
		$this->_workDays = $workDays;
		$this->_workHour = $workHour;
		$this->_hasLunchBreak = $hasLunchBreak;
		$this->_salaryActual=$salaryActual;
	}
	public function getCode()
	{
		return $this->_code;
	}
	public function getFullName()
	{
		return $this->_fullName;
	}
	public function getAge()
	{
		return $this->_age;
	}
	public function getGender()
	{
		return $this->_gender;
	}
	public function getMaritalStatus()
	{
		return $this->_maritalStatus;
	}
	public function getTotalWorkTime()
	{
		return $this->_totalWorkTime;
	}
	public function setSalary($salary)
	{
		$this->_salary=$salary;
	}
	public function getSalary()
	{
		return $this->_salary;
	}
	public function getStartWorkTime()
	{
		return $this->_startWorkTime;
	}
	public function setWorkdays($wd)
	{
		$this->_workDays=$wd;
	}
	public function getWorkdays()
	{
		return $this->_workDays;
	}
	public function getWorkhour()
	{
		return $this->_workHour;
	}
	public function getHasLunchBreak()
	{
		return $this->_hasLunchBreak;
	}
	public function setSalaryActual($salaryActual){
		$this->_salaryActual= $salaryActual;
	}
	public function getSalaryActual($salaryActual){
		return $this->_salaryActual;
	}
}
//============
class WorkTime{
	private $_memberCode;
	private $_startDatetime;
	private $_endDatetime;
	function __construct($memberCode,$startDatetime,$endDatetime){
		$this->_memberCode=$memberCode;
		$this->_startDatetime=$startDatetime;
		$this->_endDatetime=$endDatetime;
	}
	function getMemberCode(){
		return $this->_memberCode;
	}
	function getStartTime(){
		return $this->_startDatetime;
	}
	function getEndTime(){
		return $this->_endDatetime;
	}
}
$arrayWorkTime=[];
foreach ($listWorkTime as $member) {
	array_push($arrayWorkTime, new WorkTime($member["member_code"],$member["start_datetime"],$member["end_datetime"]));
}
$employeeFullTime=[];
foreach ($listMemberFullTime as $employee) {
	array_push($employeeFullTime, new Employee($employee["code"],$employee["full_name"],$employee["age"],
		$employee["gender"],$employee["marital_status"],$employee["total_work_time"],$employee["salary"],
		$employee["start_work_time"],$employee["work_hour"],$employee["has_lunch_break"]));
}
$employeePartTime=[];
foreach ($listMemberPartTime as $employee) {
	array_push($employeePartTime, new Employee($employee["code"],$employee["full_name"],$employee["age"],
		$employee["gender"],$employee["marital_status"],$employee["total_work_time"],$employee["salary"],
		$employee["start_work_time"],$employee["work_hour"],$employee["has_lunch_break"]));
}
/*-------------------------------------*/
class General
{
	const holidays = 
	[
		"2019-01-01",
		"2019-02-04",
		"2019-02-05",
		"2019-02-06",
		"2019-02-07",
		"2019-02-08",
		"2019-04-14",
		"2019-04-30",
		"2019-05-01",
		"2019-09-02"
	];
	function dateInMonth($year,$month)
	{
		return cal_days_in_month(CAL_GREGORIAN, $month, $year);
	}
//========ham tra lai ngay nghi
	function isWeekend($date)
	{
		$dayNow = getdate(strtotime($date));
		if ($dayNow["weekday"] == "Sunday" || $dayNow["weekday"] == "Saturday") {
			return true;
		}
		return false;
	}
//==========ham tinh so ngay
	function dayWorkInMonth($date) 
	{
		$dateNow = getdate(strtotime($date));
		$y = $dateNow["year"];
		$m = $dateNow["mon"];
		$holiday = 0;
		$daysInMonth = $this->dateInMonth($y, $m);
		for ($i = 1; $i <= $daysInMonth; $i++) {
			$dayNow= sprintf("%s-%02d-%02d", $y, $m, $i);
			if ($this->isWeekend($dayNow) || in_array($dayNow, General::holidays)) {
				$holiday++;
			}
		}
		return $daysInMonth - $holiday;
	}
//===============
	function getTime($data)
	{
		return date('H:i:s', strtotime($data));
	}
	function getHourWorkDay($startTimeDay, $endTimeDay)
	{ 
		$startTimeDay= $this->getTime($startTimeDay);
		$endTimeDay = $this->getTime($endTimeDay);
		return (strtotime($endTimeDay) - strtotime($startTimeDay))/3600;
	}
	function dayWorkMember($listWorkTime, $listMemberFullTime, $dataDate)
	{
		$arDate = getdate(strtotime($dataDate));
		$monthNeedCal = $arDate["mon"];
		foreach ($listMemberFullTime as $employee ) {
			$dayWork = 0;
			foreach ($listWorkTime as $workTime) {
				$monthNow=getdate(strtotime($workTime->getStartTime()));
				$monthNow=$monthNow["mon"];
				$timeWorkDay=0;
				if($employee->getCode()===$workTime->getMemberCode()&&$monthNow==$monthNeedCal){
					$startWorkTime = $employee->getStartWorkTime();
					$inTime = $this->getTime($workTime->getStartTime()); 
					$outTime = $this->getTime($workTime->getEndTime());
					$lunchBreak=$employee->getHasLunchBreak();
					if($lunchBreak){
						if (strtotime($startWorkTime) - strtotime($inTime) < 0) {
							$timeWorkDay = $this->getHourWorkDay($inTime, $outTime) - 1.5;
                    } else { // di som
                    	$timeWorkDay = $this->getHourWorkDay($startWorkTime, $outTime) - 1.5;
                    }
                    if ($timeWorkDay >= $employee->getWorkhour()) {
                    	$dayWork += 1;
                    } 
                    elseif ($timeWorkDay >= 4 || $timeWorkDay<$employee->getWorkhour()) {
                    	$dayWork += 0.5;
                    }
                } else{
						 if (strtotime($startWorkTime) - strtotime($inTime) < 0) { //di muon
						 	$timeWorkDay = $this->getHourWorkDay($inTime, $outTime);
                    } else { // di som
                    	$timeWorkDay= $this->getHourWorkDay($startWorkTime, $outTime);
                    }
                    if ($timeWorkDay >= $employee->getWorkhour()) {
                    	$dayWork += 0.5;
                    }
                }
            }
        }
        $employee->setWorkdays($dayWork);
    }
}
//===============
function moneyInMonth($employees, $date)
{
	foreach ($employees as $member ) {
		$salary=$member->getSalary();
		$workdays=$member->getWorkdays();
		$salaryActual = $workdays * ($salary / $this->dayWorkInMonth($date));
		$member->setSalaryActual($salaryActual);
	}
}
}
/*-------------------------------------*/
$gender= new General;
$gender->dayWorkMember($arrayWorkTime, $employeeFullTime, "2019-04");
$gender->dayWorkMember($arrayWorkTime, $employeePartTime, "2019-04");
$gender->moneyInMonth($employeeFullTime, "2019-04");
$gender->moneyInMonth($employeePartTime, "2019-04");
print_r($employeeFullTime);
print_r($employeePartTime);
?>
