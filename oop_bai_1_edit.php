<?php
/*nhận bài 10/6 update 24/6*/
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
class WorkTime{
    private $member_code;
    private $start_datetime;
    private $end_datetime;
    function __construct($_member_code,$_start_datetime,$_end_datetime){
        $this->member_code=$_member_code;
        $this->start_datetime=$_start_datetime;
        $this->end_datetime=$_end_datetime;
    }
    function getMemberCode(){
        return $this->member_code;
    }
    function getStartTime(){
        return $this->start_datetime;
    }
    function getEndTime(){
        return $this->end_datetime;
    }
}
$arrayWorkTime=[];
foreach ($listWorkTime as $key) {
    array_push($arrayWorkTime, new WorkTime($key["member_code"],$key["start_datetime"],$key["end_datetime"]));
}
$employeeFullTime=[];
foreach ($listMemberFullTime as $key) {
    array_push($employeeFullTime, new Employee($key["code"],$key["full_name"],$key["age"],$key["gender"],$key["marital_status"],$key["total_work_time"],$key["salary"],$key["start_work_time"],$key["work_hour"],$key["has_lunch_break"]));
}
$employeePartTime=[];
foreach ($listMemberPartTime as $key) {
    array_push($employeePartTime, new Employee($key["code"],$key["full_name"],$key["age"],$key["gender"],$key["marital_status"],$key["total_work_time"],$key["salary"],$key["start_work_time"],$key["work_hour"],$key["has_lunch_break"]));
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
    { // chen vao thoi gian "y-m-d" or "y-m" "y-m-d h-i-s"
    $arDate = getdate(strtotime($date));
    $y = $arDate["year"];
    $m = $arDate["mon"];
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
       $date= date("Y-m-d",strtotime("$date-$i"));
       if ($this->third($date) || in_array($date, $holidays)) {
        $holiday++;
    }
}
return $d - $holiday;
}
//===============
function getTime($data)
    { // lay ra gio : phut : giay cua ngay neu ngay do truyen vao co ca ngay, thang nam
        //
        return date('H:i:s', strtotime($data));
    }
    function hourWorkDay($startTimeDay, $endTimeDay)
    { 
        $startTimeDay= $this->getTime($startTimeDay);
        $endTimeDay = $this->getTime($endTimeDay);
        return (strtotime($endTimeDay) - strtotime($startTimeDay))/3600;
    }
    function listWorkTimeF($listWorkTime, $listMemberFullTime, $dataDate)
    {
        $arDate = getdate(strtotime($dataDate));
        $m = $arDate["mon"];
        foreach ($listMemberFullTime as $key ) {
            $day = 0;
            foreach ($listWorkTime as $item) {
                $time=0;
                if($key->getCode()==$item->getMemberCode()){                   
                    $startWorkTime = $key->getStartWorkTime();
                    $inTime = $this->getTime($item->getStartTime()); 
                    $outTime = $this->getTime($item->getEndTime());
                    if (strtotime($startWorkTime) - strtotime($inTime) < 0) {
                        $time = $this->hourWorkDay($inTime, $outTime) - 1.5;
                    } else { // di som
                        $time = $this->hourWorkDay($startWorkTime, $outTime) - 1.5;
                    }
                    if ($time >= $key->getWorkhour()) {
                        $day += 1;
                    } 
                    if ($time >= 4) {
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
                if($key->getCode()==$item->getMemberCode()){                   
                    $startWorkTime = $key->getStartWorkTime();
                    $inTime = $this->getTime($item->getStartTime()); 
                    $outTime = $this->getTime($item->getEndTime());
                    if (strtotime($startWorkTime) - strtotime($inTime) < 0) { //di muon
                        $time = $this->hourWorkDay($inTime, $outTime);
                    } else { // di som
                        $time = $this->hourWorkDay($startWorkTime, $outTime);
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
$gender->listWorkTimeF($arrayWorkTime, $employeeFullTime, "2019-04");
$gender->listWorkTimeP($arrayWorkTime, $employeePartTime, "2019-04");
$gender->moneyInMonthF($employeeFullTime, "2019-04");
$gender->moneyInMonthF($employeePartTime, "2019-04");
print_r($employeeFullTime);
print_r($employeePartTime);
?>
