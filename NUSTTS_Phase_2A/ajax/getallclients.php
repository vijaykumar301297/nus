<?php
include "../dbconn.php";

$getdatas = "SELECT supplierId,contract_id FROM nus_supply_contract  WHERE countryName='".$_POST['countryname']."' AND commodityName='".$_POST['commodity']."' AND clientId='".$_POST['client']."'";
$result = $conn->query($getdatas);
$clients = array();

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $clients[] = $row;
	}
}

foreach ($clients as $key => $value) {
	$printdata .='<option value="'.$value['supplierId'].'">'.$value['contract_id'].'</option>';
}
echo $printdata;
?>