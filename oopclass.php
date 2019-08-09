<?php
include("./header.php");
include ("./connect.php");
?>
<?php

class Ranch{
	private $ranch_id;
	private $name_ranch;
	private $phone_ranch;
	public function getRanchId(){
		return $this->ranch_id;
	}
	public function getNameRanch(){
		return $this->name_ranch;
	}
}
$stmt=$conn->prepare("SELECT ranch_id, name_ranch, phone_ranch FROM ranch");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_CLASS,'Ranch');
$objRanchs=$stmt->fetchAll();

class AdminRegister{
	private	$id;
	private	$ranch_calendar_id;
	private	$time_of_day;
	private	$group_reception;

	private	$monday_number_horse;
	private	$tuesday_number_horse;
	private	$wednesday_number_horse;
	private	$thursday_number_horse;
	private	$friday_number_horse;
	private	$saturday_number_horse;
	private	$sunday_number_horse;
	private	$holiday_number_horse;

	private	$monday_other_club;
	private	$tuesday_other_club;
	private	$wednesday_other_club;
	private	$thursday_other_club;
	private	$friday_other_club;
	private	$saturday_other_club;
	private	$sunday_other_club;
	private	$holiday_other_club;
	function getTimeOfDay(){
		return $this->time_of_day;
	}
	function getHorseMon(){
		return $this->monday_number_horse;
	}
	function getHorseTue(){
		return $this->tuesday_number_horse;
	}
	function getHorseWed(){
		return $this->wednesday_number_horse;
	}
	function getHorseThu(){
		return $this->thursday_number_horse;
	}
	function getHorseFri(){
		return $this->friday_number_horse;
	}
	function getHorseSat(){
		return $this->saturday_number_horse;
	}
	function getHorseSun(){
		return $this->sunday_number_horse;
	}
	function getHorseHoliday(){
		return $this->holiday_number_horse;
	}

	function getOtherMon(){
		return $this->monday_other_club;
	}
	function getOtherTue(){
		return $this->tuesday_other_club;
	}
	function getOtherWed(){
		return $this->wednesday_other_club;
	}
	function getOtherThu(){
		return $this->thursday_other_club;
	}
	function getOtherFri(){
		return $this->friday_other_club;
	}
	function getOtherSat(){
		return $this->saturday_other_club;
	}
	function getOtherSun(){
		return $this->sunday_other_club;
	}
	function getOtherHoliday(){
		return $this->holiday_other_club;
	}

}

class RanchCalendar{
	private $id;
	private $ranch_id;
	private $start_date;
	private $end_date;
	function getIdRanchCalendar(){
		return $this->id;
	}
	public function getRanchId(){
		return $this->ranch_id;
	}
	public function getStartDate(){
		return $this->start_date;
	}
	public function getEndDate(){
		return $this->end_date;
	}
}
$ranchCalendar=$conn->prepare("SELECT * FROM ranch_calendar");
$ranchCalendar->execute();
$ranchCalendar->setFetchMode(PDO::FETCH_CLASS,'RanchCalendar');
$objRanchCalendar=$ranchCalendar->fetchAll();
class TableCustomerRegist{
	private $id;
	private $nameCustomer;
	private $phoneCustomer;
	private $dateVisit;
	private $nameRanch;
	private $time_visit;
	private $name_horse;

	function getNameCustomer(){
		return $this->nameCustomer;
	}
	public function getPhoneCustomer(){
		return $this->phoneCustomer;
	}
	public function getDateVisit(){
		return $this->dateVisit;
	}
	function getNameRanch(){
		return $this->nameRanch;
	}
	public function getTimeVisit(){
		return $this->time_visit;
	}
	public function getNameHorse(){
		return $this->name_horse;
	}
}
class ShowInfo{
	private $nameRanchs;
	private $timeVisit;
	private $nameCustomers;
	private $infoCustomers;
	function getInfoSelectDate($conn,$date){
		$customerTable=$conn->prepare("SELECT * FROM register_visit_horse_info WHERE dateVisit= :dateVisit");
		$customerTable->setFetchMode(PDO::FETCH_CLASS,'TableCustomerRegist');
		$customerTable->execute([":dateVisit"=>$date]);
		$customerTable=$customerTable->fetchAll();
		return $customerTable;
	}
	function setRanchAndTime($conn,$date){
		$this->nameRanchs=[];
		$this->timeVisit=[];
		$infoRecords=$this->getInfoSelectDate($conn,$date);
		foreach ($infoRecords as $record) {
			if(!in_array($record->getNameRanch(),$this->nameRanchs)){
				array_push($this->nameRanchs,$record->getNameRanch());
			}
			if(!in_array($record->getTimeVisit(),$this->timeVisit)){
				array_push($this->timeVisit,$record->getTimeVisit());
			}
		}
	}
	function getInfoAll($time,$ranchName,$date,$conn){
		$this->nameCustomers=[];
		$this->infoCustomers=[];
		$infoAll=$conn->prepare("SELECT * FROM register_visit_horse_info WHERE nameRanch= :name_ranch AND time_visit=:time_visit AND dateVisit =:date_visit");
		$infoAll->setFetchMode(PDO::FETCH_CLASS,'TableCustomerRegist');
		$infoAll->execute([":name_ranch"=>$ranchName,":time_visit"=>$time,":date_visit"=>$date]);
		$infoAll=$infoAll->fetchAll();
		foreach ($infoAll as $info) {
			if(!in_array($info->getNameCustomer(),$this->nameCustomers)){
				array_push($this->nameCustomers,$info->getNameCustomer());
			}
		}
		foreach ($this->nameCustomers as $name) {
			$nameHorse="";
			foreach ($infoAll as $info) {
				if($info->getNameCustomer()==$name){
					$nameHorse.=$info->getNameHorse()."|";
				}
			}
			$this->infoCustomers[]=["name"=>$name,"phone"=>$info->getPhoneCustomer(),"Horse"=>$nameHorse];

		}
		return $this->infoCustomers;
	}
	function getFarm(){
		return $this->nameRanchs;
	}
	function getTimeVisit(){
		return $this->timeVisit;
	}
}
$shows=new ShowInfo;
class CaculatorSelect{
	private $ranchId;
	function selectRanch($timeSelect, $objRanchCalendar){
		$this->ranchId=[];
		$ranchId=$this->ranchId;
		foreach ($objRanchCalendar as $RanchCalendar) {
			$startDate=$RanchCalendar->getStartDate();
			$endDate=$RanchCalendar->getEndDate();
			if((strtotime($timeSelect)-strtotime($startDate))>0&&(strtotime($timeSelect)-strtotime($endDate))<0){
				array_push($ranchId,["id_ranch_calendar"=>$RanchCalendar->getIdRanchCalendar(),"ranch_id"=>$RanchCalendar->getRanchId()]);
			}
		}
		return $ranchId;
	}
}
$caculatorSelect=new CaculatorSelect;
?>