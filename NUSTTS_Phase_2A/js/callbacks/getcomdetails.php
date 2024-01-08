<?php
include "../../dbconn.php";

$getdatas = "SELECT countryName FROM nus_supply_contract  WHERE commodityName='".$_POST['commodityname']."'";
$result = $conn->query($getdatas);
$country = array();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $country[] = $row['countryName'];
	}
}
$countrylist = array_unique($country);
$printdata = '<option value>Please select country</option>';
foreach ($countrylist as $key => $value) {
	$printdata .='<option value="'.$value.'">'.$value.'</option>';
}
echo $printdata;
?>