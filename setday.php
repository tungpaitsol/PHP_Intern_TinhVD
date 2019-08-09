<?php
include("./connect.php");
$ar=["2019-02-04", "2019-02-05", "2019-02-06", "2019-02-07", "2019-02-08", "2019-04-14", "2019-04-30", "2019-05-01", "2019-09-02"];
foreach ($ar as $i) {
	$sqlInsert = $conn->prepare('INSERT INTO holiday (id, date_holiday) values (?,?)');
	$data = array('', $i);
	$sqlInsert->execute($data);
}
?>