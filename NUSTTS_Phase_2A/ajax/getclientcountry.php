<?php
include "../dbconn.php";

$getdatas = "SELECT ca.clientcompany as clients,nsc.clientId as clientid  FROM nus_supply_contract nsc INNER JOIN clientcompanydata ca ON nsc.clientId=ca.id WHERE nsc.countryName='".$_POST['countryname']."' AND nsc.commodityName='".$_POST['commodity']."'";
$result = $conn->query($getdatas);
$clients = array();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $clients[] = $row;
	}
}

function array_multi_unique($multiArray){

  $uniqueArray = array();

  foreach($multiArray as $subArray){

    if(!in_array($subArray, $uniqueArray)){
      $uniqueArray[] = $subArray;
    }
  }
  return $uniqueArray;
}

$unique = array_multi_unique($clients);

$printdata = '<option value>Please select clients</option>';
foreach ($unique as $key => $value) {
	$printdata .='<option value="'.$value['clientid'].'">'.$value['clients'].'</option>';
}
echo $printdata;
?>