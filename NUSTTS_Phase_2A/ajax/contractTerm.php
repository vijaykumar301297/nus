<?php
include '../dbconn.php';


// $contract =   $_POST['contractId'];
$contractIds = $_POST['origiContract'];
$clientId = $_POST['clientId'];

$contract_query = "SELECT * FROM nus_supply_contract WHERE contract_id = '".$contractIds."' AND clientId = '".$clientId."'";
$contract_qry = mysqli_query($conn, $contract_query);
$contractId = array();

while ($contract_row = mysqli_fetch_assoc($contract_qry)) {
	$contractId[] = $contract_row;
}

$nustrde_query = "SELECT * FROM nus_tradeperiods WHERE supplierId =".$contractId[0]['supplierId']."";
$nustrde_query = $conn->query($nustrde_query);
$contractTrade = array();

while ($row = $nustrde_query->fetch_assoc()) {
	$contractTrade[] = $row;
}
$contractterm = $contractId[0]['contractTermfromDate'].','.$contractId[0]['contractTermtoDate'];

$arrayval = array("contractTrade"=>json_encode($contractTrade),"supId"=>$contractId[0]['supplierId'],"contractterm"=>$contractterm,"consummptionamt"=>numberreturn($contractId[0]['totalAnualConsumption']), "commdityname"=>$contractId[0]['commodityName'],"vinay"=>$contractId[0]['indexStructureType']);
echo json_encode($arrayval);
// ,"noofdaysyear"=>$nody
function numberreturn($value){
	$toremovecomma = intval(preg_replace('/[^\d. ]/', '', $value));
	return $toremovecomma;
}
?>
 