<?php
include '../dbconn.php';

session_start();

if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == "Client company") {
	$activeStatus = "AND state = 'Active'";
} else {
	$activeStatus = "";
}


$contract =   $_POST['contract'];
$contract_queryindex = "SELECT * FROM nus_supply_contract WHERE clientId = '".$contract."' AND contractType='indexed' ".$activeStatus." ORDER BY contract_id ASC;";
$contract_queryindex = mysqli_query($conn, $contract_queryindex);
$contractIndexId = array();
while ($contract_row = mysqli_fetch_assoc($contract_queryindex)) {
	$contractIndexId[] = $contract_row;
}

$contract_queryfixed = "SELECT * FROM nus_supply_contract WHERE clientId = '".$contract."' AND contractType='fixed' ".$activeStatus." ORDER BY contract_id ASC;";
$contract_queryfixed = mysqli_query($conn, $contract_queryfixed);
$contractfixedId = array();
while ($contract_rows = mysqli_fetch_assoc($contract_queryfixed)) {
	$contractfixedId[] = $contract_rows;
}


$printIndex = '';
if(count($contractIndexId) ==0){
	$printIndex = '<option>Please select</option>';
}else{
	$printIndex .= '<option value>Please select</option>';
	foreach ($contractIndexId as $key => $valueIndex) {
		$printIndex .= '<option value='.$valueIndex['contract_id'].'>'.$valueIndex['contract_id'].'</option>';
	}
}

$printFixed = '';
if(count($contractfixedId) ==0){
	$printFixed = '<option>Please select</option>';
}else{
	$printFixed .= '<option value>Please select</option>';
	foreach ($contractfixedId as $key => $valueFix) {
		$printFixed .= '<option value='.$valueFix['contract_id'].'>'.$valueFix['contract_id'].'</option>';
	}
}

$arraydata = array('indexData'=>$printIndex, 'fixedData'=>$printFixed);
echo json_encode($arraydata);

// $nustrde_query = "SELECT * FROM nus_tradeperiods WHERE supplierId =".$contractId[0]['supplierId']."";
// $nustrde_query = $conn->query($nustrde_query);
// $contractTrade = array();

// while ($row = $nustrde_query->fetch_assoc()) {
// 	$contractTrade[] = $row;
// }
// $contractterm = $contractId[0]['contractTermfromDate'].','.$contractId[0]['contractTermtoDate'];
// $arrayval = array("contractTrade"=>json_encode($contractTrade),"supId"=>$contractId[0]['supplierId'],"contractterm"=>$contractterm,"consummptionamt"=>numberreturn($contractId[0]['totalAnualConsumption']));
// echo json_encode($arrayval);
// function numberreturn($value){
// 	$toremovecomma = intval(preg_replace('/[^\d. ]/', '', $value));
// 	return $toremovecomma;
// }
?>
 