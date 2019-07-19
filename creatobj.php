<?php
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
	function __construct($billFoodCode,$billCode,$foodCode,$quantity){
		$this->_billFoodCode=$billFoodCode;
		$this->_billCode=$billCode;
		$this->_foodCode=$foodCode;
		$this->_quantity=$quantity;
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

}
class BillEmployee{
	private $_billEmployeeCode;
	private $_billCode;
	private $_employeeCode;
	private $_timeIn;
	private $_timeOut;
	private $_type;
	private $_moneySevice;
	function __construct($billEmployeeCode,$billCode,$employeeCode,$timeIn,$timeOut,$type,$moneySevice=0){
		$this->_billEmployeeCode=$billEmployeeCode;
		$this->_billCode=$billCode;
		$this->_employeeCode=$employeeCode;
		$this->_timeIn=$timeIn;
		$this->_timeOut=$timeOut;
		$this->_type=$type;
		$this->_moneySevice=$moneySevice;
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
?>