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
	public function __construct($code, $fullName, $age, $gender, $maritalStatus, $totalWorkTime,
		$salary,$startWorkTime, $workHour, $hasLunchBreak, $workDays=0)
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
	function dateInMonth($year,$month)
	{
		return cal_days_in_month(CAL_GREGORIAN, $month, $year);
	}
//========ham tra lai ngay nghi
	function weekDay($date)
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
    $holidays = 
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
    $holiday = 0;
    $d = $this->dateInMonth($y, $m);
    for ($i = 1; $i <= $d; $i++) {
    	$dayNow= sprintf("%s-%02d-%02d", $y, $m, $i);
    	if ($this->weekDay($dayNow) || in_array($dayNow, $holidays)) {
    		$holiday++;
    	}
    }
    return $d - $holiday;
}
//===============
function getTime($data)
{
	return date('H:i:s', strtotime($data));
}
function hourWorkDay($startTimeDay, $endTimeDay)
{ 
	$startTimeDay= $this->getTime($startTimeDay);
	$endTimeDay = $this->getTime($endTimeDay);
	return (strtotime($endTimeDay) - strtotime($startTimeDay))/3600;
}
function dayMemberFullTime($listWorkTime, $listMemberFullTime, $dataDate)
{
	$arDate = getdate(strtotime($dataDate));
	$monthNeedCal = $arDate["mon"];
	foreach ($listMemberFullTime as $employee ) {
		$dayWork = 0;
		foreach ($listWorkTime as $workTimeDayEmployee) {
			$monthNow=getdate(strtotime($workTimeDayEmployee->getStartTime()));
			$monthNow=$monthNow["mon"];
			$timeWorkDay=0;
			if($employee->getCode()==$workTimeDayEmployee->getMemberCode()&&$monthNow==$monthNeedCal){                  
				$startWorkTime = $employee->getStartWorkTime();
				$inTime = $this->getTime($workTimeDayEmployee->getStartTime()); 
				$outTime = $this->getTime($workTimeDayEmployee->getEndTime());
				if (strtotime($startWorkTime) - strtotime($inTime) < 0) {
					$timeWorkDay = $this->hourWorkDay($inTime, $outTime) - 1.5;
                    } else { // di som
                    	$timeWorkDay = $this->hourWorkDay($startWorkTime, $outTime) - 1.5;
                    }
                    if ($timeWorkDay >= $employee->getWorkhour()) {
                    	$dayWork += 1;
                    } 
                    elseif ($timeWorkDay >= 4 || $timeWorkDay<$employee->getWorkhour()) {
                    	$dayWork += 0.5;
                    }

                }
            }
            $employee->setWorkdays($dayWork);
        }


    }

//=============================================
    function dayMemberPartTime($listWorkTime, $listMemberPartTime, $dataDate)
    {
    	$arDate = getdate(strtotime($dataDate));
    	$monthNeedCal = $arDate["mon"];
    	foreach ($listMemberPartTime as $employee ) {
    		$dayWork = 0;
    		foreach ($listWorkTime as $workTimeDayEmployee) {
    			$monthNow=getdate(strtotime($workTimeDayEmployee->getStartTime()));
    			$monthNow=$monthNow["mon"];
    			$timeWorkDay=0;
    			if($employee->getCode()==$workTimeDayEmployee->getMemberCode()&&$monthNow==$monthNeedCal){                  
    				$startWorkTime = $employee->getStartWorkTime();
    				$inTime = $this->getTime($workTimeDayEmployee->getStartTime()); 
    				$outTime = $this->getTime($workTimeDayEmployee->getEndTime());
                    if (strtotime($startWorkTime) - strtotime($inTime) < 0) { //di muon
                    	$timeWorkDay = $this->hourWorkDay($inTime, $outTime);
                    } else { // di som
                    	$timeWorkDay= $this->hourWorkDay($startWorkTime, $outTime);
                    }
                    if ($timeWorkDay >= $employee->getWorkhour()) {
                    	$dayWork += 0.5;
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
    		$salary = $workdays * ($salary / $this->dayWorkInMonth($date));
    		$member->setSalary($salary);
    	}
    }
}
/*-------------------------------------*/
$gender= new General;
$gender->dayMemberFullTime($arrayWorkTime, $employeeFullTime, "2019-04");
$gender->dayMemberPartTime($arrayWorkTime, $employeePartTime, "2019-04");
$gender->moneyInMonth($employeeFullTime, "2019-04");
$gender->moneyInMonth($employeePartTime, "2019-04");
print_r($employeeFullTime);
print_r($employeePartTime);
?>
