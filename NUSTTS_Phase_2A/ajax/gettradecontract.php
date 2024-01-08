<?php
include "../dbconn.php";

$getdatas = "SELECT supplycontractid FROM enter_trade  WHERE clientId='".$_POST['client']."'";
$result = $conn->query($getdatas);
$clients = array();

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $clients[] = $row['supplycontractid'];
	}
}
$contractlist = array_unique($clients);
$printdata ='';
$printdata .='<option>Please select Contracts</option>';
foreach ($contractlist as $key => $value) {
	$printdata .='<option value="'.$value.'">'.$value.'</option>';
}
echo $printdata;
?>