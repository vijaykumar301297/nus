<?php
include "../dbconn.php";

$getdatas = "SELECT supplierId,contract_id FROM nus_supply_contract  WHERE countryName='".$_POST['country']."' AND commodityName='".$_POST['commodity']."' AND parentId='".$_POST['parent']."'";
$result = $conn->query($getdatas);
$clients = array();

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $clients[] = $row;
	}
}
$printdata ='';
foreach ($clients as $key => $value) {
	$printdata .='<option value="'.$value['supplierId'].'">'.$value['contract_id'].'</option>';
}
echo $printdata;
?>