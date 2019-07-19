<?php
include("./creatdata.php");
include("./creatobj.php");
include("./caculatorFood.php");
include("./caculatorEmployeeBill.php");
include ("./caculatorSalary.php");
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
$monneyEmployee=new CaculatorBillEmployee($objBillEmployees,$objBills);
$monneyEmployee->setMoneyServiceBills();
$moneyFood=new CaculatorBillFood($objFoods,$objBills,$objBillsFoods);
$moneyFood->setMoneyFoodBills();
$totalBill=new TotalBill($objBills);
$totalBill->TotalBills();
$employee=new SalaryEmployee ($objBillEmployees,$objBills,$objEmployees);
$employee->setSalaryEmployess();
print_r($objBills);
print_r($objEmployees);
?>

