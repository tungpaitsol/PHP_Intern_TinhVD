<?php
include("./index1.php");
$billCode="B004";
$monneyEmployee=new CaculatorBillEmployee($objBillEmployees,$objBills);
$monneyEmployee->setMoneyService($billCode);
$moneyFood=new CaculatorBillFood($objFoods,$objBills,$objBillsFoods);
$moneyFood->setMoneyFoodBill($billCode);
$totalBill=new TotalBill($objBills);
$totalBill->TotalBill($billCode);
class ExportBill{
	private $_billCode;
	private $_date;
	private $_moneyFood;
	private $_moneyEmployee;
	private $_promotional;
	private $_total;
	private $_listFood;
	private $_listEmployee;
	function __construct($billcode,$date,$moneyFood,$moneyEmployee,$moneyPromotinal,$total,$listFood=[],$listEmployee=""){
		$this->_billCode=$billcode;
		$this->_date=$date;
		$this->_moneyFood=$moneyFood;
		$this->_moneyEmployee=$moneyEmployee;
		$this->_promotional=$moneyPromotinal;
		$this->_total=$total;
		$this->_listFood=$listFood;
		$this->_listEmployee=$listEmployee;
	}
	function getBillCode(){
		return $this->_billCode;
	}
	function getDate(){
		return $this->_date;
	}
	function getMoneyFood(){
		return $this->_moneyFood;
	}
	function getMoneyEmployee(){
		return $this->_moneyEmployee;
	}
	function getPromotional(){
		return $this->_promotional;
	}
	function getTotal(){
		return $this->_total;
	}
	function setlistFood($listFood){
		$this->_listFood=$listFood;
	}
	function getListFood(){
		return $this->_listFood;
	}
	function setlistEmployee($listEmployee){
		$this->_listEmployee=$listEmployee;
	}
	function getlistEmployee(){
		return $this->_listEmployee;
	}
}
$exportBill=[];
foreach ($objBills as $objBill) {
	array_push($exportBill,new ExportBill($objBill->getBillCode(),$objBill->getTimeOut(),$objBill->getMoneyFood(),$objBill->getMoneyEmployee(),$objBill->getPromotional(),$objBill->getTotalMoney()));
}
class CaculatorBill{
	private $_listMember;
	private $_listFood;
	private $_objBillEmployees;
	private $_exportBill;
	private $_objBillFoods;
	function __construct($objBillEmployees,$objBillFoods,$exportBill){
		$this->_exportBill=$exportBill;
		$this->_objBillEmployees=$objBillEmployees;
		$this->_objBillFoods=$objBillFoods;
	}
	function getMoneyTime($billCode){
		$this->_listMember=[];
		$listMembers=$this->_listMember;
		$objBillEmployees=$this->_objBillEmployees;
		foreach ($objBillEmployees as $objBillEmployee) {
			if($objBillEmployee->getBillCode()==$billCode){
				$timein=$objBillEmployee->getTimeIn();
				$timeout=$objBillEmployee->getTimeOut();
				$codeEmployee=$objBillEmployee->getEmployeeCode();
				$list=$objBillEmployee->getList();
				array_push($listMembers, array("employee_code"=>$codeEmployee,"timein"=>$timein,"timeout"=>$timeout,"listMoney"=>$list));
			}
		}
		return $listMembers;
	}
	function getMenuFood($billCode){
		$this->_listFood=[];
		$listFood=$this->_listFood;
		$objBillFoods=$this->_objBillFoods;
		foreach ($objBillFoods as $objBillFood) {
			if($objBillFood->getBillCode()==$billCode){
				$foodCode=$objBillFood->getFoodCode();
				$quantity=$objBillFood->getQuantity();
				$money=$objBillFood->getMoneys();
				array_push($listFood, array("food_code"=>$foodCode,"quantity"=>$quantity,"money"=>$money));
			}
		}
		return $listFood;
	}
	function setExportBill($billCode){
		$exportBills=$this->_exportBill;
		foreach ($exportBills as $exportBill) {
			if($exportBill->getBillCode()==$billCode){
				$exportBill->setlistEmployee($this->getMoneyTime($billCode));
				$exportBill->setlistFood($this->getMenuFood($billCode));
			}
		}
	}
	function getExportBill(){
		$exportBills=$this->_exportBill;
		foreach ($exportBills as $exportBill) {
			$billCode=$exportBill->getBillCode();
			$this->setExportBill($billCode);
		}
	}
}
$p=new CaculatorBill($objBillEmployees,$objBillsFoods,$exportBill);
$p->getExportBill();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hóa đơn thanh toán</title>
	<style type="text/css">
		.container{
			text-align: -webkit-center;
		}
		.form{
			width: 60%;
		}
		table, th, td {
			border: 1px solid black;
			margin: left;
		}
		table{
			width: 80%;
		}
		.food{
			margin: 15px 0;
		}
		.em{
			margin: 15px 0;
		}
		.moneybill{
			text-align: initial;
			font-size: 15pt;
			display: inline-flex;
		}
	</style>
</head>
<body>
	<?php
	foreach ($exportBill as $bill) {
		if($bill->getBillCode()==$billCode){
			$billCode=$bill->getBillCode();
			$outdate=$bill->getDate();
			echo "	<div class='container'>
			<div class='form'>
			<h1>Hóa đơn thanh toán</h1>
			<div>Mã bill: $billCode</div>
			<div>Ngày lập: $outdate</div>
			<div class='food'>
			Danh sách món ăn
			<table>
			<tr>
			<th>Tên</th>
			<th>Số lượng</th>
			<th>Thành tiền</th>
			</tr>
			";
			foreach ($bill->getListFood() as $food) {
				$foodcode=$food['food_code'];
				$quantity=$food['quantity'];
				$moneys=$food['money'];
				echo "<tr>
				<td>$foodcode</td>
				<td>$quantity</td>
				<td>$moneys</td>
				</tr>";
			};
			echo "</table>
			</div>
			<div class='em'>
			Danh sách nhân viên
			<table>
			<tr>
			<th>Mã nhân viên</th>
			<th>Thời gian vào</th>
			<th>Thời gian ra</th>
			<th>Thành tiền</th>
			</tr>";
			foreach ($bill->getlistEmployee() as $employee) {
				$employeeCode=$employee['employee_code'];
				$timeIn=$employee['timein'];
				$timeOut=$employee['timeout'];
				$money=$employee['listMoney'];
				echo "<tr>
				<td>$employeeCode</td>
				<td>$timeIn</td>
				<td>$timeOut</td>
				<td>$money</td>
				</tr>";
			}
			$moneyFood=$bill->getMoneyFood();
			$moneyEmployee=$bill->getMoneyEmployee();
			$moneyTotal=$bill->getTotal();
			$moneyPromotinal=$bill->getPromotional();
			$total=$moneyFood+$moneyEmployee;
			$pay=$bill->getTotal();
			echo "</table>
			</div>
			<div class='moneybill'>
			<div>Tiền ăn: $moneyFood</div>
			<div>Tiền Nhân viên: $moneyEmployee</div>
			<div>Tổng tiền: $total</div>
			<div>Thuế VAT 10%</div>
			<div>Giảm giá: $moneyPromotinal</div>
			<div>Thanh toán: $pay</div>
			</div>
			</div>
			</div>";
			
		}
	}
	?>
</body>
</html>