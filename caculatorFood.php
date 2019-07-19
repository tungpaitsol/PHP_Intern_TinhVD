<?php
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
?>