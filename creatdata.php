<?php
$menuFoods=[];
$menuFoods[0]=["food_code"=>"F001","food_name"=>"すき焼き","alcohol"=>0,"food_price"=>245982];
$menuFoods[1]=["food_code"=>"F002","food_name"=>"天ぷら","alcohol"=>0,"food_price"=>274638];
$menuFoods[2]=["food_code"=>"F003","food_name"=>"ホッピーワイン","alcohol"=>0.5,"food_price"=>462862];
$menuFoods[3]=["food_code"=>"F004","food_name"=>"さくら茶","alcohol"=>0,"food_price"=>291615];
$menuFoods[4]=["food_code"=>"F005","food_name"=>"両国茶","alcohol"=>0,"food_price"=>363449];
$menuFoods[5]=["food_code"=>"F004","food_name"=>"両国茶","alcohol"=>0,"food_price"=>363449];
/*-----------------------------------*/
$employees=[];
$employees[0]=["employee_code"=>"E001","full_name"=>"Lê Thị Hậu","salary"=>0];
$employees[1]=["employee_code"=>"E002","full_name"=>"Nguyen Van B","salary"=>0];
$employees[2]=["employee_code"=>"E003","full_name"=>"Nguyen Van C","salary"=>0];
$employees[3]=["employee_code"=>"E004","full_name"=>"Nguyen Van D","salary"=>0];
/*-----------------------------------*/
$billEmployees=[];
$billEmployees[0]=['bill_employee_code' => "BE001", 'bill_code' => 'B001', 'employee_code' => 'E002', 'time_in' => '2019-07-15 10:00:00', 'time_out' => '2019-07-15 11:00:00', 'type' => 0];
$billEmployees[1]=['bill_employee_code' => "BE002", 'bill_code' => 'B001', 'employee_code' => 'E001', 'time_in' => '2019-07-15 09:00:00', 'time_out' => '2019-07-15 11:00:00', 'type' => 0];
$billEmployees[2]=['bill_employee_code' => "BE003", 'bill_code' => 'B002', 'employee_code' => 'E003', 'time_in' => '2019-07-15 12:00:00', 'time_out' => '2019-07-15 14:00:00', 'type' => 1];
$billEmployees[3]=['bill_employee_code' => "BE004", 'bill_code' => 'B003', 'employee_code' => 'E004', 'time_in' => '2019-07-15 13:00:00', 'time_out' => '2019-07-15 15:00:00', 'type' => 1];
$billEmployees[4]=['bill_employee_code' => "BE005", 'bill_code' => 'B004', 'employee_code' => 'E001', 'time_in' => '2019-07-15 08:00:00', 'time_out' => '2019-07-15 09:00:00', 'type' => 0];
/*-----------------------------------*/
$table=[];
$table[0]=["table_code"=>"T001"];
$table[1]=["table_code"=>"T002"];
$table[2]=["table_code"=>"T003"];
$table[3]=["table_code"=>"T004"];
/*-----------------------------------*/
$bills=[];
$bills[0]=["bill_code"=>"B001","time_in"=>"2019-07-15 08:00:00","time_out"=>"2019-07-15 12:00:00","promotional"=>100000,"total_money"=>0];
$bills[1]=["bill_code"=>"B002","time_in"=>"2019-07-15 12:00:00","time_out"=>"2019-07-15 14:00:00","promotional"=>0,"total_money"=>0];
$bills[2]=["bill_code"=>"B003","time_in"=>"2019-07-15 13:00:00","time_out"=>"2019-07-15 16:00:00","promotional"=>150000,"total_money"=>0];
$bills[3]=["bill_code"=>"B004","time_in"=>"2019-07-15 13:00:00","time_out"=>"2019-07-15 16:00:00","promotional"=>150000,"total_money"=>0];
/*-----------------------------------*/
$billFoods=[];
$billFoods[0]=["bill_food_code"=>"BF001","bill_code"=>"B001","food_code"=>"F002","quantity"=>2];
$billFoods[1]=["bill_food_code"=>"BF002","bill_code"=>"B001","food_code"=>"F003","quantity"=>1];
$billFoods[2]=["bill_food_code"=>"BF003","bill_code"=>"B002","food_code"=>"F001","quantity"=>1];
$billFoods[3]=["bill_food_code"=>"BF004","bill_code"=>"B003","food_code"=>"F004","quantity"=>2];
$billFoods[4]=["bill_food_code"=>"BF005","bill_code"=>"B004","food_code"=>"F004","quantity"=>2];

$employeeFollowUps = [];
$employeeFollowUps["employee"] = [100000, 80000, 50000];
$employeeFollowUps["employees"] = [80000, 60000, 40000];
?>