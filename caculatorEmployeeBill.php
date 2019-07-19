<?php
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
			if($objBillEmployee->getBillCode()==$billCode){
				$moneyBillEmployeeCode=0;
				foreach ($timeWorkEmployees[$billE]["hours"] as $hour) {
					$quantityEmployee=$employeeTimes[$hour]['quantity_employee'];
					$timeEat=$employeeTimes[$hour]['time'];
					$moneyBillEmployeeCode+=CaculatorBillEmployee::sevice[$quantityEmployee-1][$timeEat-1];
				}
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
?>