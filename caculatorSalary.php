<?php
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
?>