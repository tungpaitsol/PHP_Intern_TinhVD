<?php
include("./creatdata.php");
class MenuFood{
	private $_foodCode;
	private $_foodName;
	private $_alcohol;
	private $_foodPrice;
	function __construct($foodCode,$foodName,$alcohol,$foodPrice){
		$this->_foodCode=$foodCode;
		$this->_foodName=$foodName;
		$this->_alcohol=$alcohol;
		$this->_foodPrice=$foodPrice;
	}
	function getFoodCode(){
		return $this->_foodCode;
	}
	function getFoodName(){
		return $this->_foodName;
	}
	function getAlcohol(){
		return $this->_alcohol;
	}
	function getFoodPrice(){
		return $this->_foodPrice;
	}
}
class BillFood{
	private $_billFoodCode;
	private $_billCode;
	private $_foodCode;
	private $_quantity;	
	private $_moneys;
	function __construct($billFoodCode,$billCode,$foodCode,$quantity,$alcohol=0,$moneys=0){
		$this->_billFoodCode=$billFoodCode;
		$this->_billCode=$billCode;
		$this->_foodCode=$foodCode;
		$this->_quantity=$quantity;
		$this->_moneys=$moneys;
	}
	function getBillFoodCode(){
		return $this->_billFoodCode;
	}
	function getBillCode(){
		return $this->_billCode;
	}
	function getFoodCode(){
		return $this->_foodCode;
	}
	function getQuantity(){
		return $this->_quantity;
	}
	function setMoneys($moneys){
		$this->_moneys=$moneys;
	}
	function getMoneys(){
		return $this->_moneys;
	}

}
class BillEmployee{
	private $_billEmployeeCode;
	private $_billCode;
	private $_employeeCode;
	private $_timeIn;
	private $_timeOut;
	private $_type;
	private $_moneySevice;
	private $_list;
	function __construct($billEmployeeCode,$billCode,$employeeCode,$timeIn,$timeOut,$type,$moneySevice=0,$list=[]){
		$this->_billEmployeeCode=$billEmployeeCode;
		$this->_billCode=$billCode;
		$this->_employeeCode=$employeeCode;
		$this->_timeIn=$timeIn;
		$this->_timeOut=$timeOut;
		$this->_type=$type;
		$this->_moneySevice=$moneySevice;
		$this->_list=$list;
	}
	function getBillEmployeeCode(){
		return $this->_billEmployeeCode;
	}
	function getBillCode(){
		return $this->_billCode;
	}
	function getEmployeeCode(){
		return $this->_employeeCode;
	}
	function getTimeIn(){
		return $this->_timeIn;
	}
	function getTimeOut(){
		return $this->_timeOut;
	}
	function getType(){
		return $this->_type;
	}
	function setMoneySevice($moneySevice){
		$this->_moneySevice=$moneySevice;
	}
	function getMoneySevice(){
		return $this->_moneySevice;
	}
	function setList($list){
		$this->_list=$list;
	}
	function getList(){
		return $this->_list;
	}
}
class Bill{
	private $_billCode;
	private $_timeIn;
	private $_timeOut;
	private $_promotional;
	private $_moneyFood;
	private $_moneyEmployee;
	private $_totalMoney;

	public function __construct($billCode, $timeIn, $timeOut, $promotional,$moneyFood=0,$moneyEmployee=0, $totalMoney = 0){
		$this->_billCode = $billCode;
		$this->_timeIn = $timeIn;
		$this->_timeOut = $timeOut;
		$this->_promotional = $promotional;
		$this->_moneyFood = $moneyFood;
		$this->_moneyEmployee = $moneyEmployee;
		$this->_totalMoney = $totalMoney;
	}
	public function getBillCode(){
		return $this->_billCode;
	}
	public function getTimeIn(){
		return $this->_timeIn;
	}

	public function getTimeOut(){
		return $this->_timeOut;
	}

	public function getPromotional(){
		return $this->_promotional;
	}
	public function setTotalMoney($_totalMoney){
		$this->_totalMoney=$_totalMoney;
	}
	public function getTotalMoney(){
		return $this->_totalMoney;
	}
	public function setMoneyFood($MoneyFood){
		$this->_moneyFood=$MoneyFood;
	}
	public function getMoneyFood(){
		return $this->_moneyFood;
	}
	public function setMoneyEmployee($moneyEmployee){
		$this->_moneyEmployee=$moneyEmployee;
	}
	public function getMoneyEmployee(){
		return $this->_moneyEmployee;
	}
}
class Employee{
	private $_employeeCode;
	private $_fullName;
	private $_salary;
	function __construct($employeeCode,$fullName,$salary=0){
		$this->_employeeCode=$employeeCode;
		$this->_fullName=$fullName;
		$this->_salary=$salary;
	}
	function getEmployeeCode(){
		return $this->_employeeCode;
	}
	function getFullName(){
		return $this->_fullName;
	}
	function setSalary($salary){
		$this->_salary=$salary;
	}
	function getSalary(){
		return $this->_salary;
	}
}
//----------------------------------------
$objFoods=[];
foreach ($menuFoods as $food ) {
	array_push($objFoods,new MenuFood($food['food_code'],$food['food_name'],$food['alcohol'],$food['food_price']));
}
$objBills=[];
foreach ($bills as $bill) {
	array_push($objBills,new Bill($bill['bill_code'],$bill['time_in'],$bill['time_out'],$bill['promotional']));
}
$objBillsFoods=[];
foreach ($billFoods as $billFood) {
	array_push($objBillsFoods,new BillFood($billFood['bill_food_code'],$billFood['bill_code'],$billFood['food_code'],$billFood['quantity']));
}
$objBillEmployees=[];
foreach ($billEmployees as $billEmployee) {
	array_push($objBillEmployees,new BillEmployee($billEmployee['bill_employee_code'],$billEmployee['bill_code'],$billEmployee['employee_code'],$billEmployee['time_in'],$billEmployee['time_out'],$billEmployee['type']));
}
$objEmployees=[];
foreach ($employees as $employee) {
	array_push($objEmployees, new Employee($employee['employee_code'],$employee['full_name'],$employee['salary']));
}
//----------------------------------------
class CaculatorBillFood{
	private $_objFoods;
	private $_objBills;
	private $_objBillsFoods;
	function __construct($objFoods,$objBills,$objBillsFoods){
		$this->_objFoods=$objFoods;
		$this->_objBills=$objBills;
		$this->_objBillsFoods=$objBillsFoods;
	}
	function caculatorFood($foodCode,$quantity){
		$objFoods=$this->_objFoods;
		foreach ($objFoods as $food) {
			if($foodCode==$food->getFoodCode()){
				return $food->getFoodPrice()*$quantity + 100*$food->getAlcohol();
			}
		}
	}
	function getMoneyBillFood($billCode){
		$objBillsFoods=$this->_objBillsFoods;	
		$moneyFood=0;
		foreach ($objBillsFoods as $billFood) {
			
			if($billCode==$billFood->getBillCode()){
				$moneyFood+= $this->caculatorFood($billFood->getFoodCode(),$billFood->getQuantity());
				$billFood->setMoneys($this->caculatorFood($billFood->getFoodCode(),$billFood->getQuantity()));
			}
		}
		return $moneyFood;
	}
	function setMoneyFoodBill($billCode){
		$objBills=$this->_objBills;
		foreach ($objBills as $bill) {
			if($bill->getBillCode()==$billCode){
				$moneyFood=$this->getMoneyBillFood($billCode);
				$bill->setMoneyFood($moneyFood);
			}
		}
	}
	function setMoneyFoodBills(){
		$objBills=$this->_objBills;
		foreach ($objBills as $bill) {
			$billCode=$bill->getBillCode();
			$this->setMoneyFoodBill($billCode);
		}
	}
}
class CaculatorBillEmployee{
	private $_objBillEmployees;
	private $_objBills;
	private $_timeWorkEmployeeBills;
	private $_times;
	private $_customerHours;
	private $_employeeHours;
	const sevice=[
		"0"=>[100000,80000,50000],
		"1"=>[80000,60000,40000]
	];
	function __construct($objBillEmployees,$objBills){
		$this->_objBillEmployees=$objBillEmployees;
		$this->_objBills=$objBills;
	}
	function divTime($timeStart,$timeEnd){
		$timeStart=date("H", strtotime($timeStart));
		$timeEnd=date("H", strtotime($timeEnd));
		return range($timeStart, $timeEnd-1);
	}
	function getEmployeeHour($billCode){
		$this->_employeeHours=[];
		$objBillEmployees=$this->_objBillEmployees;
		$billE=0;
		foreach ($objBillEmployees as $objBillEmployee) {
			if($objBillEmployee->getBillCode()==$billCode){
				$times=$this->divTime($objBillEmployee->getTimeIn(),$objBillEmployee->getTimeOut());
				$this->_employeeHours[$billE]["bill_employee_code"]=$objBillEmployee->getBillEmployeeCode();
				$this->_employeeHours[$billE]["hours"]=$times;
				$billE++;
			}
		}
		return $this->_employeeHours;
	}
	function getCustomerHour($billCode){
		$maxEats=3;
		$maxEmployee=2;
		$this->_timeWorkEmployeeBills=[];
		$this->_times=[];
		$employeeHours=$this->getEmployeeHour($billCode);
		foreach ($employeeHours as $employeeHour) {
			foreach ($employeeHour["hours"] as $hour) {
				array_push($this->_times, $hour);
			}
		}
		asort($this->_times);
		$times=array_count_values ($this->_times );
		$hourEat=0;
		foreach ($times as $hour => $employee) {
			$hourEat++;
			if($employee>$maxEmployee){
				$employee=2;
			}
			if($hourEat>$maxEats){
				$hourEat=3;
			}
			$this->_timeWorkEmployeeBills[$hour]=["quantity_employee"=>$employee,"time"=>$hourEat];
		}
		return $this->_timeWorkEmployeeBills;
	}
	function setMoneyServiceBillEmployee($billCode){
		$employeeTimes=$this->getCustomerHour($billCode);
		$timeWorkEmployees=$this->getEmployeeHour($billCode);
		$objBillEmployees=$this->_objBillEmployees;
		$billE=0;	
		foreach ($objBillEmployees as $objBillEmployee) {
			$list="";
			if($objBillEmployee->getBillCode()==$billCode){
				$moneyBillEmployeeCode=0;
				foreach ($timeWorkEmployees[$billE]["hours"] as $hour) {
					$quantityEmployee=$employeeTimes[$hour]['quantity_employee'];
					$timeEat=$employeeTimes[$hour]['time'];
					$list.=CaculatorBillEmployee::sevice[$quantityEmployee-1][$timeEat-1]."|";
					$moneyBillEmployeeCode+=CaculatorBillEmployee::sevice[$quantityEmployee-1][$timeEat-1];
				}
				$objBillEmployee->setList($list);
				$objBillEmployee->setMoneySevice($moneyBillEmployeeCode);
				$billE++;
			}
		}
	}
	function setMoneyService($billCode){
		$objBills=$this->_objBills;
		$objBillEmployees=$this->_objBillEmployees;
		$totalMoneyService=0;
		$this->setMoneyServiceBillEmployee($billCode);
		foreach ($objBills as $objBill) {
			if($objBill->getBillCode()==$billCode){
				foreach ($objBillEmployees as $objBillEmployee) {
					if($objBillEmployee->getBillCode()==$billCode)	{
						$totalMoneyService+=$objBillEmployee->getMoneySevice();
					}
				}
				return $objBill->setMoneyEmployee($totalMoneyService);
			}	
		}
	}
	function setMoneyServiceBills(){
		$objBills=$this->_objBills;
		foreach ($objBills as $objBill) {
			$billCode=$objBill->getBillCode();
			$this->setMoneyService($billCode);
		}
	}	
}
class SalaryEmployee{
	private $_objBillEmployees;
	private $_objBills;
	private $_objEmployees;
	function __construct($objBillEmployees,$objBills,$objEmployees){
		$this->_objBillEmployees=$objBillEmployees;
		$this->_objBills=$objBills;
		$this->_objEmployees=$_objEmployees=$objEmployees;
	}
	function getMoneyCommission($employeeCode){
		$moneyCommission=0;
		$objBillEmployees=$this->_objBillEmployees;
		foreach ($objBillEmployees as $objBillEmployee) {
			if($objBillEmployee->getEmployeeCode()==$employeeCode){
				$objBillEmployee->getBillEmployeeCode();
				$moneyCommission+=$objBillEmployee->getmoneySevice();
			}
		}
		return $moneyCommission*0.4;
	}
	function getMoneyForBill($employeeCode){
		$objBills=$this->_objBills;
		$objBillEmployees=$this->_objBillEmployees;
		$type=0;
		$moneyForBill=0;
		foreach ($objBills as $objBill) {
			foreach ($objBillEmployees as $objBillEmployee) {
				if($objBill->getBillCode()==$objBillEmployee->getBillCode() &&$objBillEmployee->getEmployeeCode()==$employeeCode) {
					$type=$objBillEmployee->getType();
					if($type==1){
						$moneyForBill+=$objBill->getTotalMoney()*0.015;
					}
					else if($type==0){
						$moneyForBill+=$objBill->getTotalMoney()*0.01;
					}
				}
				continue;
			}
		}
		return $moneyForBill;
	}
	function salary($employeeCode){
		$objEmployees=$this->_objEmployees;
		$salary=0;
		foreach ($objEmployees as $objEmployee) {
			if($objEmployee->getEmployeeCode()==$employeeCode){
				$salary=$this->getMoneyCommission($employeeCode)+$this->getMoneyForBill($employeeCode);
				return $salary;
				//return $objEmployee->setSalary($salary);
			}
		}
	}
	function setSalaryEmployess(){
		$objEmployees=$this->_objEmployees;
		foreach ($objEmployees as $objEmployee) {
			$employeeCode=$objEmployee->getEmployeeCode();
			$salarys=$this->salary($employeeCode);
			$objEmployee->setSalary($salarys);
		}
	}
}
class TotalBill{
	private $_objBills;
	function __construct($objBills){
		$this->_objBills=$objBills;
	}
	function TotalBill($billCode){
		$objBills=$this->_objBills;
		foreach ($objBills as $objBill) {
			if($objBill->getBillCode()==$billCode){
				$total=$objBill->getMoneyFood()+$objBill->getMoneyEmployee()-$objBill->getPromotional();
				$total=$total+$total*0.1;
				$objBill->setTotalMoney($total);
			}
			
		}
	}
	function TotalBills(){
		$objBills=$this->_objBills;
		foreach ($objBills as $objBill) {
			$billCode=$objBill->getBillCode();
			$this->TotalBill($billCode);
		}
	}
}
// $billCode="B001";
// $monneyEmployee=new CaculatorBillEmployee($objBillEmployees,$objBills);
// $monneyEmployee->setMoneyService($billCode);
// $moneyFood=new CaculatorBillFood($objFoods,$objBills,$objBillsFoods);
// $moneyFood->setMoneyFoodBill($billCode);
// $totalBill=new TotalBill($objBills);
// $totalBill->TotalBill($billCode);
?>
