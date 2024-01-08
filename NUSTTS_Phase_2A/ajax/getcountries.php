<?php
include "../dbconn.php";

$getdatas = "SELECT countryName FROM nus_supply_contract  WHERE parentId='".$_POST['parentcompany']."' AND commodityName='".$_POST['commdoity']."'";
$result = $conn->query($getdatas);
$clients = array();

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $clients[] = $row['countryName'];
	}
}
$getcountries = array_unique($clients);
$printdata ='<option>Please select country</option>';
foreach ($getcountries as $key => $value) {
	$printdata .='<option value="'.$value.'">'.$value.'</option>';
}
echo $printdata;
?>